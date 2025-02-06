<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UserProfileCard extends Component
{
    public $user;
    public function mount(){
        $this->user = Auth::user();
    }
    public function render()
    {
        return view('livewire.user-profile-card');
    }
}
