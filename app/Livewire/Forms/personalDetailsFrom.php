<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class personalDetailsFrom extends Form
{
    public $firstName;
    public $lastName;
    public $jobTitle;
    public $email;
    public $phone;
    public $city;

    public function rules()
    {
        return [
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'jobTitle' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|numeric|digits_between:10,15',
            'city' => 'required|string|max:255',
        ];
    }



    public function submit()
    {
        $this->validate();
        $this->reset();
        // Perform the necessary action (e.g., saving data)
        session()->flash('success', 'Personal details submitted successfully!');
    }
}
