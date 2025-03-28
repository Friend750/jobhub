<?php

namespace App\Livewire;

use App\Livewire\Forms\CoursesForm;
use App\Livewire\Forms\EducationForm;
use App\Livewire\Forms\ExperienceForm;
use App\Livewire\Forms\ProfessionalSummaryForm;
use App\Livewire\Forms\ProjectsForm;
use App\Livewire\Forms\SkillsForm;
use App\Livewire\Forms\WebsitesLinksForm;
use App\Models\Connection;
use App\Models\Conversation;
use App\Models\Course;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Language;
use App\Models\Link;
use App\Models\Project;
use App\Models\Skill;
use App\Models\User;
use App\Notifications\Request;
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

    // update skills
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
        $link->update([
            'website_name' => $this->WLForm->websites[0]['website_name'],
            'link' => $this->WLForm->websites[0]['link'],
        ]);
        $link->save();

        session()->flash('link_updated', 'The Link has been updated. Refresh the page to refresh the link list');
    }

    public function deleteLink(link $link)
    {
        $link->delete();
        $this->user->links()->detach($link->id);
        session()->flash('link_deleted', 'The Link has been deleted.');
    }

    public function getOldPS()
    {
        $this->PSForm->oldData();
    }

    public function updateExp(){
        $this->experiences = $this->user->experiences()->latest()->get();
    }

    public function getOldExp(Experience $experience)
    {
        $this->ExperienceForm->oldData($experience);
    }

    public function deleteExp()
    {
        $this->ExperienceForm->deleteExperience();
        $this->updateExp();
    }

    public function saveExperience()
    {
        $this->ExperienceForm->submit();
        $this->updateExp();
        $this->dispatch('close-modal');
        session()->flash('ExperienceMsg', 'تم تحديث الملف الشخصي');
    }

    public function updatePro(){
        $this->projects = $this->user->Projects()->latest()->get();
    }

    public function getOldPro(Project $project)
    {
        $this->ProjectsForm->oldData($project);
    }

    public function deletePro()
    {
        $this->ProjectsForm->deleteProject();
        $this->updatePro();
    }

    public function saveProject()
    {
        $this->ProjectsForm->submit();
        $this->updatePro();
        $this->dispatch('close-modal');
        session()->flash('ProjectMsg', 'تم تحديث الملف الشخصي');
    }
    public function updateEdu(){
        $this->educations = $this->user->Educations()->latest()->get();
    }

    public function getOldEdu(Education $education)
    {
        $this->EDForm->oldData($education);
    }

    public function deleteEdu()
    {
        $this->EDForm->deleteEducation();
        $this->updateEdu();
    }

    public function saveEducation()
    {
        $this->EDForm->submit();
        $this->updateEdu();
        $this->dispatch('close-modal');
        session()->flash('EducationMsg', 'تم تحديث الملف الشخصي');
    }

    public function updateCourses(){
        $this->courses = $this->user->Courses()->latest()->get();
    }

    public function getOldCourse(Course $course)
    {
        $this->CoursesForm->oldData($course);
    }

    public function deleteCourse()
    {
        $this->CoursesForm->deleteCourse();
        $this->updateCourses();
    }

    public function saveCourse()
    {
        $this->CoursesForm->submit();
        $this->updateCourses();
        $this->dispatch('close-modal');
        session()->flash('CourseMsg', 'تم تحديث الملف الشخصي');
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

    public function getFollowStatus($userId)
    {
        $connection = Connection::where('follower_id', $userId)
        ->where('following_id', Auth::id())
        ->first();


        return [
            'isFollowing' => $connection && $connection->is_accepted == 1, // Active following
            'isRequested' => $connection && $connection->is_accepted == 0, // Pending request
        ];
    }

    public function unFollow($connectionId)
{
    Connection::where('follower_id', $connectionId)
    ->where('following_id', Auth::id())
    ->delete();

    $this->dispatch('connectionUpdated');
}


public function follow($connectionId)
{

    $receiver = User::find($connectionId);
    Connection::create([
        'follower_id' => $connectionId,
        'following_id' => Auth::id(),
        'is_accepted' => 0
    ]);
    $receiver->notify(new Request(Auth::user(),$receiver));

}

public function startConversation($userId)
{
    $conversation = Conversation::where(function ($query) use ($userId) {
        $query->where('first_user', Auth::id())
              ->where('second_user', $userId);
    })
    ->orWhere(function ($query) use ($userId) {
        $query->where('first_user', $userId)
              ->where('second_user', Auth::id());
    })
    ->first();

if (!$conversation) {
    // إذا لم تكن المحادثة موجودة، قم بإنشائها
    $conversation = Conversation::create([
        'first_user' => Auth::id(),
        'second_user' => $userId,
    ]);
}
    // التوجيه إلى شاشة المحادثة
        return redirect()->route('chat', ['conversationId' => $conversation->id]);
}
    public function render()
    {
        return view('livewire.user-profile');
    }
}
