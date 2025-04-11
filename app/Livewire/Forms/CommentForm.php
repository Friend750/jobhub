<?php

namespace App\Livewire\Forms;

use App\Models\Comment;
use App\Models\JobPost;
use App\Models\Post;
use App\Models\ReplyComment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
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
