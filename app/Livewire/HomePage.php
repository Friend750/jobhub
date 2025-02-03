<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Component;

class HomePage extends Component
{
    #[Title('Welcome Home')]

    public function mount()
    {
        if (auth()->user()) {
            redirect('/posts');
        }
    }
    public function render()
    {
        return view('livewire.home-page');
    }
}
