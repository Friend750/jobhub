<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Username extends Component
{
    public string $username = ''; // Store username from child component

    protected $listeners = ['usernameUpdated' => 'setUsername']; // Listen for username changes

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function updateUsername()
    {
        if($this->username === "")
        {
            session()->flash('error', ('This username was already taken'));
        }
        else
        {
        $user = Auth::user();
        $user->update(['user_name' => $this->username]);
        return redirect()->route('typeaccount'); // Redirect to another page
        }
    }
    public function render()
    {
        return view('livewire.username');
    }
}
