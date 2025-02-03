<?php

namespace App\Livewire\Includes;

use App\Models\User;
use Livewire\Component;

class CheckEmail extends Component
{
    public $email;
    public $emailExists = false;
    public $errorMessage = '';

    public function updatedEmail()
    {
        if (!empty($this->email)) {
            // تحقق مما إذا كان البريد الإلكتروني مستخدمًا بالفعل
            $this->emailExists = User::where('email', $this->email)->exists();

            if ($this->emailExists) {
                $this->errorMessage = 'البريد الإلكتروني مسجل بالفعل، يرجى استخدام بريد آخر.';
            } else {
                $this->errorMessage = '';
            }
        } else {
            $this->emailExists = false;
            $this->errorMessage = '';
        }
    }
    public function render()
    {
        return view('livewire.includes.check-email');
    }
}
