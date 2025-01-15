<?php

namespace App\Livewire\Dashboard;

use App\Models\User;
use Livewire\Attributes\Title;
use Livewire\Component;

class Dashboard extends Component
{
    #[Title('Dashboard')]

    public $currentSection = 'home'; // Default section

    public $adminCount;
    public $userCount;
    public $activatedCount;
    public $connectedCount;

    public function switchSection($section)
    {
        $this->currentSection = $section;
    }

    public function mount()
    {
        $this->adminCount = User::where('type', 'admin')->count();
        $this->userCount = User::where('type', 'user')->count();
        $this->activatedCount = User::where('is_active', true)->count();
        $this->connectedCount = User::where('is_connected', true)->count();
    }

    public function render()
    {
        return view('livewire.dashboard.dashboard');
    }
}
