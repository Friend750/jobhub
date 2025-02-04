<?php

namespace App\Livewire;

use App\Models\Interest;
use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Title;

class SelectInterests extends Component
{
    #[Title('Interests')]
    // This will hold something like:
    // [
    //   'Business' => ['Marketing', 'Economy', ...],
    //   'Technology' => ['Web Development', 'Cybersecurity', ...]
    // ]
    public $groupedInterests = [];

    // Keep track of which interests the user has selected.
    public $selectedInterests = [];

    // ID of the authenticated user
    public $userId;

    public function mount()
    {
        $user = auth()->user();
                if (!empty($user->interests)) {
            // For instance, redirect them to the dashboard if they already have interests
            return redirect()->to('/posts');
        }
        // Store the authenticated user’s ID
        $this->userId = auth()->id();

        // 1) Fetch all interests (id, name, type). You only need name & type for display.
        $allInterests = Interest::select('name', 'type')->get();

        // 2) Group them by type: Eloquent\Collection->groupBy('type')
        // Then map to just get the names (pluck('name'))
        $this->groupedInterests = $allInterests
            ->groupBy('type')
            ->map(fn($items) => $items->pluck('name'))
            ->toArray();
    }

    public function nextStep()
    {
        $user = User::find($this->userId);

        // Validate that the user selects at least two interests
        if (count($this->selectedInterests) < 2) {
            session()->flash('error', __('general.error_interests'));
            return;
        }

        // Save the selected interests to the user’s "interests" attribute
        // Make sure your `users` table has an `interests` (JSON or text) column
        $user->interests = $this->selectedInterests;
        $user->save();

        // Redirect to whatever page is next
        return redirect()->to('EnhanceProfile');
    }

    public function render()
    {
        // Pass the groupedInterests to the Blade view
        return view('livewire.select-interests');
    }
}
