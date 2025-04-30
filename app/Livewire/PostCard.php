<?php

namespace App\Livewire;

use App\Livewire\Forms\ArticleForm;
use App\Livewire\Forms\CommentForm;
use App\Livewire\Forms\JobOfferForm;
use App\Livewire\Traits\ConnectionTrait;
use App\Models\Comment;
use App\Models\Connection;
use App\Models\Interest;
use App\Models\JobPost;
use App\Models\Post;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\ReplyComment;
use App\Models\User;
use App\Notifications\Like;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class PostCard extends Component
{
    use WithFileUploads;
    use WithPagination;
    use ConnectionTrait;


    #[Title('Feed')]

    public JobOfferForm $JOForm;
    public ArticleForm $articleForm;
    public CommentForm $commentForm;
    public $showCard;
    public $selected;
    public $target = 'connection_only';
    public $selectedInterests = [];
    public $interests;
    public $media; // For the uploaded file (image or video)
    public $user;
    public $posts;
    public $jopPosts;
    public $isLiked;

    public function setAudience($value)
    {
        $this->target = $value;
    }

    public function likeItem($itemId, $type)
    {
        $liker = $this->user;

        $post = $type === 'post'
            ? Post::find($itemId)
            : JobPost::find($itemId);

        if ($type === 'post') {
            $liker->likes()->attach($itemId);

        } elseif ($type === 'job') {
            $liker->jobLikes()->attach($itemId);
        }
        User::find($post->user_id)->notify(new Like(Auth::user(), Auth::user()->personal_details, $post->user_id, $post));

    }

    public function unlikeItem($itemId, $type)
    {
        $liker = $this->user;

        if ($type === 'post') {

            // find id
            $post = Post::find($itemId);
            $liker->likes()->detach($post->id);

        } elseif ($type === 'job') {

            // find id
            $jobPost = JobPost::find($itemId);
            $liker->jobLikes()->detach($jobPost->id);
        }
    }

    public function getLikesCount($itemId, $type)
    {
        if ($type === 'job') {
            return JobPost::find($itemId)->jobLikes()->count();
        } elseif ($type === 'post') {
            return Post::find($itemId)->likes()->count();
        }

        return 0;
    }

    public function updatedMedia()
    {
        $this->articleForm->updateMedia($this->media);
    }

    // removeMedia
    public function removeMedia()
    {
        $this->articleForm->removeMedia();
    }

    public function resetForm($selectedForm)
    {
        if ($selectedForm == 'content-article') {
            $this->articleForm->reset();
        } else {
            $this->JOForm->reset();
        }
    }

    public function resetAllForms()
    {
        $this->articleForm->reset();
        $this->JOForm->reset();
        $this->selectedInterests = [];
    }

    public function SubmitArticleForm()
    {
        $this->articleForm->submit($this->selectedInterests, $this->target);
        $this->dispatch('article-posted');
    }
    public function SubmitJobOfferForm()
    {
        $this->JOForm->submit($this->selectedInterests, $this->target);

        $this->dispatch('job-offer-posted', ['message' => 'Job Offer posted successfully']);
    }

    public function deletePost($itemID, $type)
    {
        if ($type === 'post') {
            $post = Post::find($itemID);
            $post->delete();
        } elseif ($type === 'job') {
            $jobPost = JobPost::find($itemID);
            $jobPost->delete();
        }
    }
    public $perPage = 10;

    public function loadMore()
    {
        $this->perPage += 10;
    }

    public function createComment($postId, $postType)
    {
        $this->commentForm->submit($postId, $postType);
    }

    public function mount()
    {
        $this->showCard = false;
        $this->selected = 'content-article';
        $this->interests = Interest::select('id', 'name')->get();
        $this->user = Auth::user();
        $this->posts = Post::all()->sortByDesc('created_at');
        // dd($this->posts);
    }

    public function render()
    {

        if (!Auth::user()->followings()->exists())
 {

            $sameInterestsUsers = Auth::user()->sameInterests();

            $jobPosts = JobPost::forFeed()
                ->whereIn('user_id', $sameInterestsUsers->pluck('id'))
                ->where('target', 'to_any_one')
                ->orWhere('user_id', $this->user->id);



            $normalPosts = Post::forFeed()
                ->whereIn('user_id', $sameInterestsUsers->pluck('id'))
                ->where('target', 'to_any_one')
                ->orWhere('user_id', $this->user->id);



        } else {
            $followedIds = Connection::where('following_id', $this->user->id)
                ->where('is_accepted', 1)
                ->pluck('follower_id');

            $followedIdsPublic = Connection::where('following_id', $this->user->id)
                ->where('is_accepted', 0)
                ->pluck('follower_id');

            $jobPosts = JobPost::forFeed()
                ->where(function ($query) use ($followedIds) {
                    $query->whereIn('user_id', $followedIds);
                })
                ->orWhere('user_id', $this->user->id);

            $normalPosts = Post::forFeed()
                ->where(function ($query) use ($followedIds) {
                    $query->whereIn('user_id', $followedIds);
                })
                ->orWhere('user_id', $this->user->id);




            $preview = (clone $jobPosts)->unionAll(clone $normalPosts)->get();
            if ($preview->isEmpty()) {
                // fallback to public
                $jobPosts = JobPost::forFeed()
                    ->where(function ($query) use ($followedIdsPublic) {
                        $query->whereIn('user_id', $followedIdsPublic)
                            ->where('target', 'to_any_one');
                    })
                    ->orWhere('user_id', $this->user->id);

                $normalPosts = Post::forFeed()
                    ->where(function ($query) use ($followedIdsPublic) {
                        $query->whereIn('user_id', $followedIdsPublic)
                            ->where('target', 'to_any_one');
                    })
                    ->orWhere('user_id', $this->user->id);

            }
        }

        $jobPosts = $jobPosts->with(['comments', 'user.personal_details',])->get();
        $normalPosts = $normalPosts->with(['comments', 'user.personal_details'])->get();
        $merged = $jobPosts->merge($normalPosts)->sortByDesc('created_at')->values();



// بعد عملية الدمج:
$page = request()->get('page', 1);
$offset = ($page - 1) * $this->perPage;

$paginated = new LengthAwarePaginator(
    $merged->slice($offset, $this->perPage)->values(),
    $merged->count(),
    $this->perPage,
    $page,
    ['path' => request()->url(), 'query' => request()->query()]
);





        return view('livewire.post-card', [
            'allPosts' => $paginated
        ]);

    }
}
