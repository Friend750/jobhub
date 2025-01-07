<?php

namespace App\Livewire;

use Livewire\Attributes\Title;
use Livewire\Component;

class FollowersScreen extends Component
{
    #[Title('Followers')]
    public $companies = [
        ['id' => 1, 'name' => 'Ali Qayed', 'position' => 'Software Engineer at Google / Ex-SED Amazon', 'is_following' => false],
        ['id' => 1, 'name' => 'Ali Qayed', 'position' => 'Software Engineer at Google / Ex-SED Amazon', 'is_following' => true],
        ['id' => 1, 'name' => 'Ali Qayed', 'position' => 'Software Engineer at Google / Ex-SED Amazon', 'is_following' => false],
        ['id' => 1, 'name' => 'Ali Qayed', 'position' => 'Software Engineer at Google / Ex-SED Amazon', 'is_following' => true],
        ['id' => 1, 'name' => 'Ali Qayed', 'position' => 'Software Engineer at Google / Ex-SED Amazon', 'is_following' => false],

        // Add more people as needed
    ];
    public function render()
    {
        return view('livewire.followers-screen');
    }
}
