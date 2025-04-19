<?php

namespace App\Livewire\Forms;

use App\Models\Comment;
use App\Models\JobPost;
use App\Models\Post;
use App\Models\ReplyComment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use App\Notifications\Comment as CommentNotification;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CommentForm extends Form
{
    #[Rule('required')]
    public $content = '';

    public function submit($postId, $type) // 'post' or 'job'
    {
        $this->validate();


        $commentable = $type === 'post'
            ? Post::find($postId)
            : JobPost::find($postId);

        $commentable->comments()->create([
            'user_id' => Auth::id(),
            'content' => $this->content,
        ]);

         User::find($commentable->user_id)->notify(new CommentNotification(Auth::user(),Auth::user()->personal_details, $this->content, $commentable->user_id,$commentable));

        $this->reset();
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

}
