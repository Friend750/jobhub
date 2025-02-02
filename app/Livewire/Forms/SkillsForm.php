<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class SkillsForm extends Form
{
    #[Rule([
        'skills' => 'required|array|min:1',
        'skills.*' => 'exists:skills,id',
    ])]
    public $skills = [];

    public function submit($SelectedSkills)
    {
        // the name of current property must be different
        // it will not work if set $this->SelectedSkills = $SelectedSkills
        $this->skills = $SelectedSkills;

        // dd($this->SelectedSkills);
        $this->validateOnly('skills');
        // $this->reset();
    }

}
