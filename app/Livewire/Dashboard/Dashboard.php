<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;

class Dashboard extends Component
{
    public $currentSection = 'home'; // Default section

    public function switchSection($section)
    {
        $this->currentSection = $section;
    }

    public function render()
    {
        return view('livewire.dashboard.dashboard');
    }
}
