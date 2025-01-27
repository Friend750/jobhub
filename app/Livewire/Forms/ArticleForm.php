<?php

namespace App\Livewire\Forms;

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

    public $content =""; // For the text input
    public $media; // For the uploaded file (image or video)
    public $mediaPreview; // For displaying preview

    public function updatedMedia()
    {
        $this->validateOnly('media');
        $this->mediaPreview = $this->media->temporaryUrl();
    }

    public function submit()
    {
        dump('article submit');
        // $this->validate();

        // // Save the media to storage
        // if ($this->media) {
        //     $mediaPath = $this->media->store('uploads', 'public');
        // }

        // $this->reset();
    }

}
