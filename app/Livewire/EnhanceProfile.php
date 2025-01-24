<?php

namespace App\Livewire;

use App\Livewire\Forms\CoursesForm;
use App\Livewire\Forms\EducationForm;
use App\Livewire\Forms\personalDetailsFrom;
use App\Livewire\Forms\ProfessionalSummaryForm;
use App\Livewire\Forms\SkillsForm;
use App\Livewire\Forms\WebsitesLinksForm;
use App\Models\Skill;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

class EnhanceProfile extends Component
{
    #[Title('Profile Enhancement')]
    public $activeSections = [];
    public personalDetailsFrom $PDFrom;
    public ProfessionalSummaryForm $PSForm;
    public WebsitesLinksForm $WLForm;
    public EducationForm $EDForm;
    public CoursesForm $CoursesForm;
    public SkillsForm $SkillsForm;
    public $SelectedSkills;

    // WebsitesLinksForm
    public function addRow()
    {
        $this->WLForm->addRow();
    }
    public function removeRow($index)
    {
        $this->WLForm->removeRow($index);
    }

    // EducationForm
    public function addEducationRow()
    {
        $this->EDForm->addRow();
    }
    public function removeEducationRow($index)
    {
        $this->EDForm->removeRow($index);
    }

    // CoursesForm
    public function addCourseRow()
    {
        $this->CoursesForm->addRow();
    }
    public function removeCourseRow($index)
    {
        $this->CoursesForm->removeRow($index);
    }

    public function IsActive($section)
    {
        return in_array($section, $this->activeSections);
    }

    public function saveAllForms()
    {
        // dd($this->SkillsForm->SelectedSkills);
        $this->PDFrom->submit();

        if ($this->IsActive('professional_summary')) {
            $this->PSForm->submit();
        }

        if ($this->IsActive('websites_social_links')) {
            $this->WLForm->submit();
        }

        if ($this->IsActive('education')) {
            $this->EDForm->submit();
        }

        if ($this->IsActive('courses')) {
            $this->CoursesForm->submit();
        }

        if ($this->IsActive('skills')) {
            $this->SkillsForm->submit($this->SelectedSkills);
        }

        // sesstion flash message
        session()->flash('message', 'Profile Updated Successfully');

    }


    public function render()
    {
        return view('livewire.enhance-profile', [
            'skills' => Skill::select('id', 'name')->get()
        ]);
    }
}
