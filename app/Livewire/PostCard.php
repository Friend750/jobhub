<?php

namespace App\Livewire;

use App\Livewire\Traits\LoadCommentsTrait;
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
use App\Services\FeedService;
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
    use LoadCommentsTrait;


    #[Title('Feed')]

    public JobOfferForm $JOForm;
    public ArticleForm $articleForm;
    public CommentForm $commentForm;
    public $showCard;
    public $selected;
    public $target = 'to_any_one';
    public $selectedInterests = [];
    public $interests;
    public $media; // For the uploaded file (image or video)
    public $user;
    public $jopPosts;
    public $isLiked;
    public $usersToMention = [];

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
    // داخل Livewire Component
    public function createReplyComment($commentId)
    {
        $comment = Comment::findOrFail($commentId);
        return $this->commentForm->replyComment($comment);
    }

    public function loadUsersToMention()
    {
        // Fetch users to mention (you can customize the query as needed)
        $this->usersToMention = User::select('users.id', DB::raw("CONCAT(personal_details.first_name, ' ', personal_details.last_name) AS name"), 'users.user_name', 'users.user_image')
            ->join('personal_details', 'users.id', '=', 'personal_details.user_id')
            ->get()
            ->toArray();
            // dd($this->usersToMention);
    }

    public function mount()
    {
        $this->showCard = false;
        $this->selected = 'content-article';
        $this->interests = Interest::select('id', 'name')->get();
        $this->user = Auth::user();
    }

    public function render()
    {
        $feedService = new FeedService();
        $allPosts = $feedService->getFeedForUser($this->user);
        // dd($allPosts);
        return view('livewire.post-card', [
            'allPosts' => $this->paginatePosts($allPosts),
        ]);
    }

    protected function paginatePosts($posts)
    {
        $page = request()->get('page', 1);
        $offset = ($page - 1) * $this->perPage;

        return new LengthAwarePaginator(
            $posts->slice($offset, $this->perPage)->values(),
            $posts->count(),
            $this->perPage,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );
    }
}
