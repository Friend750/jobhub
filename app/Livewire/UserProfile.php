<?php

namespace App\Livewire;

use App\Livewire\Forms\CoursesForm;
use App\Livewire\Forms\EducationForm;
use App\Livewire\Forms\ExperienceForm;
use App\Livewire\Forms\ProfessionalSummaryForm;
use App\Livewire\Forms\ProjectsForm;
use App\Livewire\Forms\SkillsForm;
use App\Livewire\Forms\WebsitesLinksForm;
use App\Models\Language;
use App\Models\Link;
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
    public WebsitesLinksForm $WLForm;
    public $profilePicture; // Stores the uploaded file
    public $skills;
    public $availableSkills;
    // public $selectedSkillName;
    public $languages;
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

    public function getAvailableSkills()
    {
        $skillIds = array_column($this->skills, 'id');
        return Skill::whereNotIn('id', $skillIds)->get();
    }

    public function UpdateSkill($id, $currentID)
    {
        $this->user->skills()->detach($currentID);
        $this->user->skills()->syncWithoutDetaching($id);

        $this->dispatch('updated-skill');
        session()->flash('skill_updated', 'The Skill has been updated. Refresh the page to refresh the skill list');
    }

    public function deleteSkill(Skill $skill)
    {
        $this->user->skills()->detach($skill->id);
        session()->flash('skill_deleted', 'The Skill has been deleted. Refresh the page to refresh the skill list');
    }

    public function getAvailableLanguages()
    {
        $languageIds = array_column($this->languages, 'id');
        return Language::whereNotIn('id', $languageIds)->get();
    }
    public function UpdateLanguage($id, $currentID)
    {
        // remove first
        $this->user->languages()->detach($currentID);
        // add new
        $this->user->languages()->syncWithoutDetaching($id);

        $this->dispatch('updated-language');
        session()->flash('language_updated', 'The Langugae has been updated. Refresh the page to refresh the language list');
    }

    public function deleteLanguage(Language $language)
    {
        $this->user->languages()->detach($language->id);
        session()->flash('language_deleted', 'The Langugae has been deleted.Refresh the page to refresh the language list');
    }

    public function deleteWebsite(Link $link)
    {
        $link->delete();
        $this->user->links()->detach($link->id);
        session()->flash('website_deleted', 'The Website has been deleted.Refresh the page to refresh the website list');
    }

    public function getLink(Link $link)
    {
        $this->WLForm->getLink($link->website_name, $link->link);
    }

    public function updateLink(link $link)
    {

        // dd($this->WLForm->websites[0]['website_name']);
        // update link
        $link->update([
            'website_name' => $this->WLForm->websites[0]['website_name'],
            'link' => $this->WLForm->websites[0]['link'],
        ]);
        $link->save();

        session()->flash('link_updated', 'The Link has been updated. Refresh the page to refresh the link list');
    }

    protected $listeners = ['deleteItem'];

    public function deleteLink(link $link)
    {
        $link->delete();
        $this->user->links()->detach($link->id);
        session()->flash('link_deleted', 'The Link has been deleted.');
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
