<?php

namespace App\Livewire\Includes;

use Livewire\Component;

class CheckPassword extends Component
{
    public $password;
    public $errorMessage = '';

    public function updatedPassword()
    {
        if (!empty($this->password)) {
            if (strlen($this->password) < 8) {
                $this->errorMessage = 'يجب أن تكون كلمة المرور على الأقل 8 أحرف.';
            } else {
                $this->errorMessage = '';
            }
        } else {
            $this->errorMessage = '';
        }
    }
    public function render()
    {
        return view('livewire.includes.check-password');
    }
}
