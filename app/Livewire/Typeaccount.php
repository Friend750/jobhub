<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Component;

class Typeaccount extends Component
{
    public $accountType = 'personal'; // Default value to match the checked radio input

    public function save()
    {
        // Validate input
        $this->validate([
            'accountType' => 'required|in:personal,company',
        ]);

        // Map account types to database-compatible values
        $type = $this->accountType === 'personal' ? 'user' : 'company';

        // Update the authenticated user's type
        $user = Auth::user();
        $user->update(['type' => $type]);

        // Redirect or emit an event
        return redirect('/interests');
    }
    #[Title('Account Type')]
    public function render()
    {
        return view('livewire.typeaccount');
    }
}
