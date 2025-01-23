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
    public $activeSections = ['Personal_Details'];
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

    public function IsActive($section)
    {
        return in_array($section, $this->activeSections);
    }

    public function saveAllForms()
    {

        if ($this->IsActive('personal_details')) {
            $this->PDFrom->submit();
        }

        if ($this->IsActive('professional_summary')) {
            $this->PSForm->submit();
        }

        if ($this->IsActive('websites_social_links')) {
            $this->WLForm->submit();
        }

        // sesstion flash message
        session()->flash('message', 'Profile Updated Successfully');

    }


    public function render()
    {
        return view('livewire.enhance-profile', [
            'skills' => Skill::select('name')->get()
        ]);
    }
}
