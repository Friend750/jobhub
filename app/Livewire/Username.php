<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Username extends Component
{



    public string $username = ''; // Store username from child component


    public function updateUsername()
    {
        if($this->username === "")
        {
            session()->flash('error', ('لا يمكن ان يكون اسم المستخدم فارغ'));
        }
        else if(User::where('user_name', $this->username)->exists())
        {
            session()->flash('error', ('اسم المستخدم مستخدم نرجو تغيير اسم المستخدم'));

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
