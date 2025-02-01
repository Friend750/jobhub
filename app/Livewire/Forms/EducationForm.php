<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class EducationForm extends Form
{

    #[Rule([
        'educations.*.institution_name' => 'required|string',
        'educations.*.certification_name' => 'required|string',
        'educations.*.degree' => 'required|string',
        'educations.*.location' => 'required|string',
        'educations.*.description' => 'nullable|string',
        'educations.*.graduation_date' => 'required|date|before_or_equal:today',
    ])]
    public $educations = [
        [
            'institution_name' => '',
            'certification_name' => '',
            'degree' => '',
            'location' => '',
            'description' => '',
            'graduation_date' => '',
        ]
    ];

    protected $messages = [
        'educations.*.degree.required' => 'Degree :position is required please.',
        'educations.*.institution_name.required' => 'Institution name :position is required.',
        'educations.*.location.required' => 'Location :position is required.',
        'educations.*.certification_name.required' => 'Certification name :position is required.',
        'educations.*.graduation_date.required' => 'Graduation date :position is required.',
        'educations.*.graduation_date.date' => 'Graduation date :position must be valid.',
        'educations.*.graduation_date.before_or_equal' => 'Graduation date :position cannot be in the future.',
        'educations.*.description.string' => 'Description :position must be valid.',
    ];

    public function addRow()
    {
        $this->educations[] = [
            'institution_name' => '',
            'certification_name' => '',
            'degree' => '',
            'location' => '',
            'description' => '',
            'graduation_date' => '',
        ];
    }

    public function removeRow($index)
    {
        unset($this->educations[$index]);
        $this->educations = array_values($this->educations);
    }


    public function submit()
    {
        $this->validate();
        $this->reset();
    }
}
