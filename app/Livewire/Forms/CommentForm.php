<?php

namespace App\Livewire\Forms;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CommentForm extends Form
{
    #[Rule('required')]
    public $content = '';

    public function submit(Post $post){
        if($this->content != ''){
            $this->validate();
        }

        Comment::create([
            'user_id' => Auth::id(),
            'post_id' => $post->id,
            'content' => $this->content,
        ]);
        $this->reset();
    }
}
