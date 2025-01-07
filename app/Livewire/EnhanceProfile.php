<?php

namespace App\Livewire;

use Livewire\Attributes\Title;
use Livewire\Component;

class EnhanceProfile extends Component
{
    #[Title('Profile Enhancement')]
    public function render()
    {
        return view('livewire.enhance-profile');
    }
}
