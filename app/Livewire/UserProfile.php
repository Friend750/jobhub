<?php

namespace App\Livewire;

use App\Models\Skill;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

class UserProfile extends Component
{
    use WithFileUploads;
    #[Title('Profile')]

    public $skills = [];
    // public $modalName ="null";


    public $profilePicture; // Stores the uploaded file
    public $temporaryUrl;   // Stores the temporary URL for preview

    public function updatedProfilePicture()
    {
        // Validate the uploaded image
        $this->validate([
            'profilePicture' => 'image|max:2048', // Limit file size to 2MB
        ]);

        // Generate a temporary URL for the uploaded file
        if ($this->profilePicture) {
            $this->temporaryUrl = $this->profilePicture->temporaryUrl();
        }
    }
    public function mount()
    {
        $this->skills = Skill::pluck('name')->toArray(); // Get a flat array of skill names
    }

    public function render()
    {
        return view('livewire.user-profile', ['skills' => $this->skills]);
    }
}
