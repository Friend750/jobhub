<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class ProfessionalSummaryForm extends Form
{
    public $description;
    public function rules()
    {
        return [
            'description' => 'required|string|min:50|max:500',
        ];
    }

    public function submit()
    {
        $this->validate();
        $this->reset();
        // Handle the submission logic (e.g., save to the database)
    }
}
