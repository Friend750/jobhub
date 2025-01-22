<?php

namespace App\Livewire;

use App\Livewire\Forms\personalDetailsFrom;
use App\Livewire\Forms\ProfessionalSummaryForm;
use App\Livewire\Forms\WebsitesLinksForm;
use App\Models\Skill;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

class EnhanceProfile extends Component
{
    #[Title('Profile Enhancement')]
    public $SelectedSkills = [];
    public personalDetailsFrom $PDFrom;
    public ProfessionalSummaryForm $PSForm;
    public WebsitesLinksForm $WLForm;

    public function addRow()
    {
        $this->WLForm->addRow();
    }
    public function removeRow($index)
    {
        $this->WLForm->removeRow($index);
    }

    public function saveAllForms()
    {
        // method 1
        // This will validate all forms but can't run submit methods for each form
        // $this->validate();

        // method 2 -- access only validataions -- don't work
        // $this->PDFrom->validate();
        // $this->PSForm->validate();
        // $this->WLForm->validate();

        // method 3 with buildin validation -- works!
        $this->PDFrom->submit();
        $this->PSForm->submit();
        $this->WLForm->submit();
        dd('All forms are valid');
    }


    public function render()
    {
        return view('livewire.enhance-profile', [
            'skills' => Skill::select('name')->get()
        ]);
    }
}
