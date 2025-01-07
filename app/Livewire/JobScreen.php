<?php

namespace App\Livewire;

use Livewire\Attributes\Title;
use Livewire\Component;

class JobScreen extends Component
{
    #[Title('Jobs')]
    public function render()
    {
        return view('livewire.job-screen');
    }
}
