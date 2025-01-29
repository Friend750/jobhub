<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class JobOfferForm extends Form
{
    #[Rule([
        'job_title' => 'required|string|max:255',
        'about_job' => 'required|string',
        'job_tasks' => 'required|string',
        'job_conditions' => 'required|string',
        'job_skills' => 'required|string',
        'job_location' => 'required|string|max:255',
        'job_timing' => 'required|string|max:255',
    ])]

    public $job_title = "";
    public $about_job = "";
    public $job_tasks = "";
    public $job_conditions = "";
    public $job_skills = "";
    public $job_location = "";
    public $job_timing = "";

        public function resetForm(){
        // dump('reset job offer form');
        $this->reset();
    }


    public function submit()
    {
        $this->validate();
        $this->reset();
    }
}
