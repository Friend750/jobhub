<?php

namespace App\Livewire\CareerAI;

use App\Models\Position;
use Livewire\Component;
use Livewire\WithFileUploads;

class UplaodJobProfile extends Component
{
    use WithFileUploads;

    public $cv;
    public $jobTitle;
    public $jobDescription;

    public $positions;
    public function mount()
    {
        $this->positions = Position::all();
    }


    public function render()
    {
        return view('livewire.careerAI.uplaod-job-profile');
    }
}
