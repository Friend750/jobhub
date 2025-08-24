<?php

namespace App\Livewire;

use App\Livewire\Forms\CommentForm;
use App\Models\JobPost;
use App\Models\Post;
use Livewire\Component;
use App\Models\User;
use App\Notifications\Like;
use Illuminate\Support\Facades\Auth;
class GetArticleLink extends Component
{
    public CommentForm $commentForm;

    public $articleId;
    // This property can be used to pass the article ID to the component
    public $id;
    public $UserID;
    public $post;
    public $Posts;
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
    public function createComment($postId, $postType)
    {
        $this->commentForm->submit($postId, $postType);
    }


    public function mount()
    {
        if ($this->id != null) {
            $this->articleId = $this->id;
            $this->Posts = Post::find($this->articleId);

            // Post::find($id) returns:
            // A Post model object if found
            // null if not found

            if (!$this->Posts) {
                $this->Posts = collect(); // Empty collection
            } else {
                $this->Posts = collect([$this->Posts]); // Wrap single post in collection
            }

        } else {
            $user = User::find($this->UserID);
            $this->Posts = $user ? $user->posts()->latest()->get() : collect();
        }
    }
    public function render()
    {
        return view('livewire.get-article-link');
    }
}
