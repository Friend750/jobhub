<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class SkillsForm extends Form
{
    #[Validate([
        'skills' => 'required|array|min:2',
        'skills.*' => 'exists:skills,id',
    ])]
    public $skills = [];

    public function submit($SelectedSkills)
    {
        $this->skills = $SelectedSkills;

        // dd($this->SelectedSkills);
        $this->validateOnly('skills');
    }

}
