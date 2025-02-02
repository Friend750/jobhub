<?php

namespace App\Livewire;

use App\Livewire\Forms\CoursesForm;
use App\Livewire\Forms\EducationForm;
use App\Livewire\Forms\ExperienceForm;
use App\Livewire\Forms\ProfessionalSummaryForm;
use App\Livewire\Forms\ProjectsForm;
use App\Livewire\Forms\SkillsForm;
use App\Models\Skill;
use App\Models\User;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

class UserProfile extends Component
{
    use WithFileUploads;
    #[Title('Profile')]

    public ProfessionalSummaryForm $PSForm;
    public ExperienceForm $ExperienceForm;
    public ProjectsForm $ProjectsForm;
    public EducationForm $EDForm;
    public CoursesForm $CoursesForm;
    public SkillsForm $SkillsForm;


    public $skills = [];
    public $profilePicture; // Stores the uploaded file
    public $temporaryUrl;   // Stores the temporary URL for preview
    public $SelectedSkills;
    public $searchQuery = ''; // Search query
    public $selectedSkillId = null; // Selected skill ID
    public $selectedSkillName = ''; // Selected skill name


    public function updatedProfilePicture()
    {
        // Validate the uploaded image
        $this->validate([
            'profilePicture' => 'image|max:2048', // Limit file size to 2MB
        ]);

        // Generate a temporary URL for the uploaded file
        if ($this->profilePicture) {
            $this->temporaryUrl = $this->profilePicture->temporaryUrl();
        }
    }

    public function saveSummary()
    {
        $this->PSForm->submit();
        $this->dispatch('close-modal');
    }

    public function saveExperience()
    {
        $this->ExperienceForm->submit();
        $this->dispatch('close-modal');
    }

    public function saveProject()
    {
        $this->ProjectsForm->submit();
        $this->reset();
        $this->dispatch('close-modal');
    }

    public function saveEducation()
    {
        $this->EDForm->submit();
        $this->dispatch('close-modal');
    }

    public function saveCourse()
    {
        $this->CoursesForm->submit();
        $this->dispatch('close-modal');
    }

    public function updatedSearchQuery()
    {
        $this->skills = Skill::where('name', 'like', '%' . $this->searchQuery . '%')
            ->get()
            ->toArray();
    }

    public function selectSkill($skillId, $skillName)
    {
        $this->selectedSkillId = $skillId;
        $this->selectedSkillName = $skillName;
        $this->searchQuery = ''; // Clear the search query

        $this->dispatch('update-skill');
        // dump($this->selectedSkillId, $this->selectedSkillName);
    }


    public $allowedSkills;
    public function mount()
    {
        $this->skills = Skill::all()->toArray();
    }

    public function render()
    {
        return view('livewire.user-profile');
    }
}
