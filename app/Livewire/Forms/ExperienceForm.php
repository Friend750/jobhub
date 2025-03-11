<?php

namespace App\Livewire\Forms;

use App\Models\Experience;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Rule;
use Livewire\Form;

class ExperienceForm extends Form
{
    #[Rule([
        'experiences.*.job_title' => 'required|string|max:80',
        'experiences.*.company_name' => 'required|string|max:80',
        'experiences.*.start_date' => 'required|date|before_or_equal:today',
        'experiences.*.end_date' => 'required|date|after:start_date',
        'experiences.*.description' => 'required|string|min:20|max:500',
        'experiences.*.location' => 'required|string|max:80',
    ])]
    public $ExperienceId = null;

    public $experiences = [
        [
            'job_title' => '',
            'company_name' => '',
            'start_date' => '',
            'end_date' => '',
            'description' => '',
            'location' => '',
        ]
    ];

    protected $messages = [
        'experiences.*.job_title.required' => 'The job title :position is required.',
        'experiences.*.company_name.required' => 'The company name :position is required.',
        'experiences.*.start_date.required' => 'The start date :position is required.',
        'experiences.*.start_date.before_or_equal' => 'The start date must be in the past',
        'experiences.*.end_date.required' => 'The end date :position is required.',
        'experiences.*.end_date.after' => 'The end date must be after the start date.',
        'experiences.*.description.required' => 'The description :position is required.',
        'experiences.*.description.min' => 'The description must be at least :min characters long.',
        'experiences.*.location.required' => 'The location :position is required.',
    ];

    public function addRow()
    {
        $this->experiences[] = [
            'job_title' => '',
            'company_name' => '',
            'start_date' => '',
            'end_date' => '',
            'description' => '',
            'location' => '',
        ];
    }

    public function removeRow($index)
    {
        unset($this->experiences[$index]);
        $this->experiences = array_values($this->experiences);
    }

    public function oldData(Experience $experience)
    {
        $this->experiences = [
            [
                'job_title' => $experience->job_title ?? '',
                'company_name' => $experience->company_name ?? '',
                'start_date' => $experience->start_date ? $experience->start_date->format('Y-m-d') : '',
                'end_date' => $experience->end_date ? $experience->end_date->format('Y-m-d') : '',
                'description' => $experience->description ?? '',
                'location' => $experience->location ?? '',
            ]
        ];
        $this->ExperienceId = $experience->id;
    }

    public function deleteExperience()
    {
        $experience = Experience::find($this->ExperienceId);

        if ($experience && $experience->user_id === Auth::id()) {
            $experience->delete();
            // ExperienceMsg
            session()->flash('ExperienceMsg', 'The Experience has been deleted.');
        } else {
            session()->flash('ExperienceMsg', 'You are not authorized to delete this experience or it does not exist.');
        }

        $this->reset('ExperienceId');
    }
    public function submit()
    {

        $validated = $this->validate();
        foreach ($validated['experiences'] as $experience) {
            Experience::updateOrCreate(
                [
                    'id' => $this->ExperienceId,
                    'user_id' => Auth::id(),
                ],
                [
                    'job_title' => $experience['job_title'],
                    'company_name' => $experience['company_name'],
                    'start_date' => $experience['start_date'],
                    'end_date' => $experience['end_date'],
                    'description' => $experience['description'],
                    'location' => $experience['location'],
                ]
            );
        }

    }
}
