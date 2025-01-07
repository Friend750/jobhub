<?php

namespace App\Livewire;

use Livewire\Attributes\Title;
use Livewire\Component;

class Typeaccount extends Component
{
    #[Title('Account Type')]
    public function render()
    {
        return view('livewire.typeaccount');
    }
}
