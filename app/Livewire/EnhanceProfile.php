<?php

namespace App\Livewire;

use App\Livewire\Forms\CoursesForm;
use App\Livewire\Forms\EducationForm;
use App\Livewire\Forms\ExperienceForm;
use App\Livewire\Forms\LanguagesForm;
use App\Livewire\Forms\personalDetailsFrom;
use App\Livewire\Forms\ProfessionalSummaryForm;
use App\Livewire\Forms\ProjectsForm;
use App\Livewire\Forms\SkillsForm;
use App\Livewire\Forms\WebsitesLinksForm;
use App\Models\Language;
use App\Models\Skill;
use Livewire\Attributes\Title;
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
    public ExperienceForm $ExperienceForm;
    public ProjectsForm $ProjectsForm;
    public LanguagesForm $LanguagesForm;
    public $SelectedSkills;
    public $Selectedlanguages;

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

    // ExperienceForm
    public function addExperience(){
        $this->ExperienceForm->addRow();
    }
    public function removeExperience($index){
        $this->ExperienceForm->removeRow($index);
    }

    // ProjectsForm
    public function addProject(){
        $this->ProjectsForm->addRow();
    }
    public function removeProject($index){
        $this->ProjectsForm->removeRow($index);
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

        if ($this->IsActive('experiences')) {
            $this->ExperienceForm->submit();
        }

        if ($this->IsActive('projects')) {
            $this->ProjectsForm->submit();
        }

        if ($this->IsActive('languages')) {
            $this->LanguagesForm->submit($this->Selectedlanguages);
        }

        // sesstion flash message
        session()->flash('message', 'Profile Updated Successfully');
    }


    public function render()
    {
        return view('livewire.enhance-profile', [
            'skills' => Skill::select('id', 'name')->get(),
            'languages' => Language::select('id', 'language')->get(),
        ]);
    }
}
