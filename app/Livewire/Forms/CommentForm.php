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
    ? Post::findOrFail($postId)
    : JobPost::findOrFail($postId);


        $commentable->comments()->create([
            'user_id' => Auth::id(),
            'content' => $this->content,
        ]);

if ($commentable->user_id !== auth()->id()) {
    $commentable->user->notify(
        new CommentNotification(
            auth()->user(),
            auth()->user()->personal_details,
            $this->content,
            $commentable->user_id,
            $commentable
        )
    );
}

        $this->reset();
    }

    public function replyComment(Comment $comment, $content)
{
    $this->validate([
        'content' => 'required|string|min:1|max:5000',
    ]);

    // Check if the user is posting too quickly
    if (Cache::has('comment_limit_' . auth()->id())) {
        session()->flash('error', 'You are posting too quickly.');
        return;
    }

    // إنشاء رد على تعليق موجود
    $reply = Comment::create([
        'user_id'    => auth()->id(),
        'content'    => $content,
        'parent_id'  => $comment->id,           // الربط مع التعليق الأب
        'commentable_id'   => $comment->commentable_id,   // نفس البوست/الوظيفة
        'commentable_type' => $comment->commentable_type, // نفس النوع (Post أو JobPost)
    ]);

    // إشعار لصاحب التعليق الأصلي (ما عدا إذا هو نفس الشخص)
    if ($comment->user_id !== auth()->id()) {
        $comment->user->notify(
            new CommentNotification(
                auth()->user(),
                auth()->user()->personal_details,
                $content,
                $comment->user_id,
                $comment->commentable
            )
        );
    }

    // حط كاش لمنع السبام (مثلاً ثانية واحدة)
    Cache::put('comment_limit_' . auth()->id(), true, now()->addSeconds(1));

    $this->reset('content');
}


}
