<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
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
        if (Auth::check()) { // Only redirect if the user is authenticated
            return redirect('/posts');
        }
    }
    public function render()
    {
        return view('livewire.home-page');
    }
}
