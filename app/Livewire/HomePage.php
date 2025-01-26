<?php

namespace App\Livewire;

use Livewire\Attributes\Title;
use Livewire\Component;

class HomePage extends Component
{
    #[Title('Welcome Home')]

    public function loadData()
    {
        sleep(3); // Simulate a delay for the database query
    }
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
