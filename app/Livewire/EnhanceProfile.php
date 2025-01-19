<?php

namespace App\Livewire;

use App\Livewire\Forms\personalDetailsFrom;
use App\Livewire\Forms\ProfessionalSummaryForm;
use App\Models\Skill;
use Livewire\Attributes\Title;
use Livewire\Component;

class EnhanceProfile extends Component
{
    #[Title('Profile Enhancement')]
    public $SelectedSkills = [];

    public personalDetailsFrom $PDFrom;
    public ProfessionalSummaryForm $PSForm;

    public function mount()
    {
        $this->PDFrom->email = auth()->user()->email;
    }

    public function savePersonalDetails(){
        $this->PDFrom->submit();
    }

    public function saveProfessionalSummary(){
        $this->PSForm->submit();
    }

    public function saveAllForms()
    {
        $this->validate();
    }
        public function render()
    {
        return view('livewire.enhance-profile', [
            'skills' => Skill::select('name')->get()
        ]);
    }
}
