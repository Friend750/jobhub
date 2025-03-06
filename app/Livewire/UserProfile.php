<?php

namespace App\Livewire;

use App\Livewire\Forms\CoursesForm;
use App\Livewire\Forms\EducationForm;
use App\Livewire\Forms\ExperienceForm;
use App\Livewire\Forms\ProfessionalSummaryForm;
use App\Livewire\Forms\ProjectsForm;
use App\Livewire\Forms\SkillsForm;
use App\Models\Language;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;
use Intervention\Image\Drivers\Gd\Driver as GdDriver;

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

    public $allowedSkills;
    public $profilePicture; // Stores the uploaded file
    public $SelectedSkills;
    public $searchQuery = ''; // Search query
    public $lagSearchQuery = ''; // Search query
    public $selectedSkill_id = ''; // Selected skill name
    public $selectedLanguage_id = ''; // Selected skill name
    public $skills;
    public $availableSkills;
    public $selectedSkillName;
    public $languages;
    public $Selectedlanguage;
    public $availableLanguages;

    public function updatedProfilePicture()
    {
        $this->validate([
            'profilePicture' => 'image|max:2048',
        ]);

        try {
            // Delete the old profile picture if it exists
            if ($this->user->user_image) {
                Storage::disk('public')->delete($this->user->user_image);
            }

            // Store the original image and get the path (Laravel auto-generates a unique name)
            $imagePath = $this->profilePicture->store('profile-pictures', 'public');

            // Load the stored image for resizing
            $manager = new ImageManager(new GdDriver());

            $resizedImage = $manager->read(Storage::disk('public')->path($imagePath))->scale(width: 300);

            // Save the resized image back to the same path
            $resizedImage->save(Storage::disk('public')->path($imagePath));

            // Update the user's profile picture path in the database
            $this->user->update([
                'user_image' => $imagePath,
            ]);

            session()->flash('message', 'Profile picture updated successfully.');
        } catch (\Exception $e) {
            session()->flash('error', 'An error occurred while updating the profile picture: ' . $e->getMessage());
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
        $this->availableSkills = $this->getAvailableSkills();
    }

    public function updatedLagSearchQuery()
    {
        $this->availableLanguages = $this->getAvailableLanguages();
    }


    public function selectSkill($id, $name = "")
    {
        // dd($id);
        $this->selectedSkill_id = $id;
        $this->selectedSkillName = $name;
        $this->searchQuery = ''; // Clear the search query

        $this->dispatch('update-skill');
    }

    public function editLanguage(Language $language)
    {
        $this->selectedLanguage_id = $language->id;
        $this->Selectedlanguage = $language->language;

        $this->reset('lagSearchQuery');
        $this->getAvailableLanguages();
        $this->dispatch('update-language');
    }

    public $editedLanguge;
    public function selectLanguage(Language $language){
        $this->editedLanguge = $language;

        // dd($this->editedLanguge->id);
    }

    public function UpdateLanguage($id){
        // remove first
        $this->user->languages()->detach($this->selectedLanguage_id);
        $this->user->languages()->syncWithoutDetaching($id);
        // flash message
        $this->dispatch('updated-language');
        session()->flash('refresh_msg', 'Refresh the page to refresh the language list');
    }

    public function getAvailableSkills()
    {
        $skillsIds = array_column($this->skills, 'id');
        return Skill::whereNotIn('id', $skillsIds)->when($this->searchQuery, function ($query) {
            $query->where('name', 'like', '%' . $this->searchQuery . '%');
        })->get();
    }

    public function getAvailableLanguages()
    {
        $languageIds = array_column($this->languages, 'id');

        return Language::whereNotIn('id', $languageIds)->when($this->lagSearchQuery, function ($query) {
            $query->where('language', 'like', '%' . $this->lagSearchQuery . '%');
        })->get();
    }


    public $user;
    public $experiences;
    public $projects;
    public $educations;
    public $courses;
    public function mount($id = 0)
    {
        // $this->skills = Skill::all()->toArray();
        $this->user = User::find(Auth::user()->id);
        if ($id != 0) {
            $this->user = User::findOrFail($id);
        }

        $this->skills = $this->user->skills()
            ->get()
            ->toArray();
        $this->availableSkills = $this->getAvailableSkills();

        $this->languages = $this->user->languages()->get()->toArray();
        $this->availableLanguages = $this->getAvailableLanguages();

        $this->experiences = $this->user->Experiences;
        $this->projects = $this->user->Projects;
        $this->educations = $this->user->Educations;
        $this->courses = $this->user->Courses;
    }
    public function render()
    {
        return view('livewire.user-profile');
    }
}
