<?php

namespace App\Livewire\Includes;

use App\Models\User;
use Livewire\Component;

class CheckUsername extends Component
{
    public $username;
    public $usernameExists = false;
    public $errorMessage = '';

    public function updatedUsername()
    {

        // التحقق من وجود المستخدم في قاعدة البيانات
        if (User::where('user_name', $this->username)->exists())
        {
            $this->usernameExists = true;
            $this->errorMessage = 'اسم المستخدم محجوز، يرجى اختيار اسم آخر.';
        }
        else
        {
            $this->dispatch('usernameUpdated', $this->username);
            $this->usernameExists = false;
            $this->errorMessage = '';
        }
    }
    public function render()
    {
        return view('livewire.includes.check-username');
    }
}
