<?php

namespace App\Livewire\Dashboard;

use Livewire\Attributes\Title;
use Livewire\Component;

class Dashboard extends Component
{
    #[Title('Dashboard')]

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
