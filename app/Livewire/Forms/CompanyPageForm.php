<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class CompanyPageForm extends Form
{
    public $page_name;
    public $description;

    protected $rules = [
        'page_name' => 'required|min:3|max:255',
        'description' => 'required|min:10|max:1000',
    ];

    protected $messages = [
        'page_name.required' => 'The page name is required.',
        'page_name.min' => 'The page name must be at least 3 characters.',
        'description.required' => 'The description is required.',
        'description.min' => 'The description must be at least 10 characters.',
    ];

    public function save()
    {
        $this->validate();

        // Save the form data to the database or perform other actions
        // Example:
        // personal::create([
        //     'page_name' => $this->page_name,
        //     'professional_summary' => $this->description,
        // ]);

        session()->flash('message', 'Company page saved successfully!');
    }
}
