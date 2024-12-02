<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class CreatePostOverlay extends Component
{
    use WithFileUploads;
    
    public $content;
    public $media;
    public $showCard;
    public $mediaPreview; // For displaying preview
    protected $rules = [
        'content' => 'required|min:10',
        'media' => 'nullable|image|max:1024',
    ];

    public function mount($showCard)
    {
        $this->showCard = $showCard;
    }


    public function updatedMedia()
    {
        $this->validateOnly('media');
        $this->mediaPreview = $this->media->temporaryUrl();
    }

    public function submit()
    {
        $this->validate();
        // Perform your save logic here

        // Reset the form and close the card
        session()->flash('message', 'Post created successfully!');
        $this->reset(['content', 'media', 'showCard', 'mediaPreview']);
    }

    public function render()
    {
        // dd($this->showCard);
        return view('livewire.create-post-overlay');
    }
}
