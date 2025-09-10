<?php

namespace App\Livewire\Forms;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Rule;
use Livewire\Form;
use Livewire\WithFileUploads;

class ArticleForm extends Form
{
    use WithFileUploads;

    #[Rule([
        'content' => 'required|string',
        'media' => 'nullable|image|max:1024', // 1MB max
    ])]

    public $content = ""; // For the text input
    public $media; // For the uploaded file (image or video)
    public $mediaPreview; // For displaying preview

    public function updateMedia($media)
    {
        $this->media = $media;
        $this->validateOnly('media');
        $this->mediaPreview = $this->media->temporaryUrl();
    }

    public function removeMedia()
    {
        $this->media = null;
        $this->mediaPreview = null;
    }

    public function resetForm()
    {
        // dump('reset article form');
        $this->reset();
    }


    public function submit($selectedInterests, $target)
    {
        $mediaPath = "";
        $this->validate();

        // Save the media to storage
        if ($this->media) {
            $mediaPath = $this->media->store('uploads', 'public');
        }
        $newPost = Post::create([
            'user_id' => Auth::id(),
            'content' => $this->content,
            'target' => $target,
            'post_image' => $mediaPath,
            'tags' => $selectedInterests,
            'views' => 0, // set views to 0 when a new post is created. It will be incremented when the post is viewed.
        ]);

        $this->reset();
        // dd($newPost);
        // return $newPost->id;
    }

}
