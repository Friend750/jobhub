<?php

namespace App\Livewire;

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
        $this->skills = [
            'skill 1',
            'skill 2',
            'skill 3',
            'skill 4',
            'skill 5',
            'skill 6',
            'skill 6',
            'skill 7',
            'skill 8',
            'skill 9',
            'skill 10'
            ,
            'skill 11',
            'skill 12',
            'skill 13',
            'skill 14',
            'skill 15'
        ];
    }

    public function render()
    {
        return view('livewire.user-profile', ['skills' => $this->skills]);
    }
}
