<?php

namespace App\Livewire\Forms;

use App\Livewire\EnhanceProfile;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Form;

class personalDetailsFrom extends Form
{
    #[Rule('required|string|max:255')]
    public $firstName = "";

    #[Rule('required|string|max:255')]
    public $lastName = "";

    #[Rule('required|string|max:255')]
    public $jobTitle = "";

    #[Rule('required|email|max:255')]
    public $email = "";

    #[Rule('required|numeric|digits_between:10,15')]
    public $phone = "";

    #[Rule('required|string|max:255')]
    public $city = "";

    public function submit()
    {
        $this->validate();
        // $this->reset();
    }
}
