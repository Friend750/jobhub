<?php

namespace App\Livewire;

use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithFileUploads;

class PostCard extends Component
{
    use WithFileUploads;
    #[Title('Feed')]

    public $content; // For the text input
    public $media; // For the uploaded file (image or video)
    public $mediaPreview; // For displaying preview
    public $showCard = false;

    protected $rules = [
        'content' => 'required|min:2',
        'media' => 'nullable|image|max:2048',
    ];

    #[Url()]
    public $selectedCities = [];
    public $interests = [
        'Marketing',
        'Technology',
        'Economy',
        'Business',
        'Administration',
        'E-commerce',
        'IT Management',
    ];

    public function updatedMedia()
    {
        $this->validateOnly('media');
        $this->mediaPreview = $this->media->temporaryUrl();
    }

    public function submit()
    {
        $this->validate();

        // Save the media to storage
        if ($this->media) {
            $mediaPath = $this->media->store('uploads', 'public');
        }

        // Example: Save post data (Adjust logic to suit your needs)
        // Post::create([
        //     'content' => $this->content,
        //     'media_path' => $mediaPath ?? null,
        // ]);
        dd($this->selectedCities);
        session()->flash('message', 'Post created successfully!');
        $this->reset(['content', 'media', 'mediaPreview','showCard']);
    }

    public function render()
    {
        return view('livewire.post-card');
    }
}
