<?php

namespace App\Livewire;

use App\Livewire\Forms\ArticleForm;
use App\Livewire\Forms\CommentForm;
use App\Livewire\Forms\JobOfferForm;
use App\Models\Comment;
use App\Models\Interest;
use App\Models\JobPost;
use App\Models\Post;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Like;
use App\Models\ReplyComment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;

class PostCard extends Component
{
    use WithFileUploads;
    use WithPagination;

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

    public $posts;
    public $jopPosts;

    public function setAudience($value)
    {
        $this->target = $value;
    }

    public function isExisting($post)
    {
        return Like::where('user_id', Auth::user()->id)
            ->where('post_id', $post->id)
            ->first();
    }
    public function toggleLike($post)
    {
        $existingLike = $this->isExisting($post);

        if ($existingLike) {
            $existingLike->delete();
        } else {
            Like::create([
                'user_id' => Auth::user()->id,
                'post_id' => $post->id,
            ]);
        }
    }

    public function createComment($post, $content)
    {
        $this->validate([
            'content' => 'required|string|min:1|max:5000',
        ]);

        // Check if the user is posting too quickly
        if (Cache::has('comment_limit_' . Auth::user()->id)) {
            session()->flash('error', 'You are posting too quickly.');
            return;
        }


        Comment::create([
            'user_id' => Auth::user()->id,
            'post_id' => $post->id,
            'content' => $content
        ]);
    }

    public function replayComment($comment, $content)
    {
        $this->validate([
            'content' => 'required|string|min:1|max:5000',
        ]);

        // Check if the user is posting too quickly
        if (Cache::has('comment_limit_' . Auth::user()->id)) {
            session()->flash('error', 'You are posting too quickly.');
            return;
        }
        ReplyComment::create([
            'user_id' => Auth::user()->id,
            'comment_id' => $comment->id,
            'content' => $content
        ]);

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

        $this->dispatch('article-posted', ['message' => 'Article posted successfully']);
    }
    public function SubmitJobOfferForm()
    {
        $this->JOForm->submit($this->target);

        $this->dispatch('job-offer-posted', ['message' => 'Job Offer posted successfully']);
    }

    public function mount()
    {
        $this->showCard = false;
        $this->selected = 'content-article';
        $this->interests = Interest::select('id', 'name')->get();

        $this->posts = Post::all()->sortByDesc('created_at');
    }

    public $perPage = 5;

    public function loadMore()
    {
        $this->perPage += 5;
    }

    public function render()
    {
        $allPosts = JobPost::forFeed()->
            unionAll(Post::forFeed())
            ->orderBy('created_at', 'desc')
            ->paginate($this->perPage);

            
        return view('livewire.post-card', [
            'allPosts' => $allPosts
        ]);

    }
}
