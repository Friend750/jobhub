<?php

namespace App\Livewire\Forms;

use App\Models\Education;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class EducationForm extends Form
{
    public $EducationId;
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

    public function oldData(Education $education)
    {
        $this->educations = [
            [
                'degree' => $education->degree ?? '',
                'certification_name' => $education->certification_name ?? '',
                'institution_name' => $education->institution_name ?? '',
                'graduation_date' => $education->graduation_date->format('Y-m-d') ?? '',
                'location' => $education->location ?? '',
                'description' => $education->description ?? '',
            ]
        ];
        $this->EducationId = $education->id;
    }

    public function deleteEducation()
    {
        $education = Education::find($this->EducationId);

        if ($education && $education->user_id === Auth::id()) {
            $education->delete();
            session()->flash('EducationMsg', 'The Education entry has been deleted.');
        } else {
            session()->flash('EducationMsg', 'You are not authorized to delete this education entry or it does not exist.');
        }

        $this->reset('EducationId');
    }

    public function submit()
    {
        $validated = $this->validate();
        foreach ($validated['educations'] as $education) {

            Education::updateOrCreate(
                [
                    'id' => $this->EducationId, // Use the stored EducationId for updates
                    'user_id' => Auth::id(), // Ensure the education entry belongs to the authenticated user
                ],
                [
                    'user_id' => Auth::id(),
                    'degree' => $education['degree'],
                    'certification_name' => $education['certification_name'],
                    'institution_name' => $education['institution_name'],
                    'graduation_date' => $education['graduation_date'],
                    'location' => $education['location'],
                    'description' => $education['description'],
                ]
            );
        }
        $this->reset();
    }
}
