<?php

namespace App\Livewire\Forms;

use App\Livewire\EnhanceProfile;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Form;

class ProfessionalSummaryForm extends Form
{
    #[Rule('required|string|min:50|max:500')]
    public $description = "";

    public function submit()
    {
        $this->validate();
        $this->reset();
    }

}
