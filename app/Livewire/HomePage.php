<?php

namespace App\Livewire;

use Livewire\Component;

class HomePage extends Component
{


    public function loadData()
    {
        sleep(3); // Simulate a delay for the database query
    }
    public function render()
    {
        return view('livewire.home-page');
    }
}
