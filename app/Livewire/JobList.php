<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver as GdDriver;
use App\Models\JobPost;
use Illuminate\Support\Facades\Auth;

class JobList extends Component
{
    use WithPagination;

    public $sortBy = 'relevant'; // معيار الفرز الافتراضي
    public $timeFilter = ''; // فلترة الوقت
    public $selectedJob = null; // تخزين الوظيفة المحددة
    public $profilePicture; // صورة الملف الشخصي

    protected $listeners = ['jobAdded' => '$refresh'];

    public function mount()
    {
        if (!$this->selectedJob && JobPost::exists()) {
            $this->selectedJob = JobPost::latest()->first();
        }
    }

    public function updatingSortBy()
    {
        $this->resetPage();
    }

    public function updatingTimeFilter()
    {
        $this->resetPage();
    }

    public function resetFilters()
    {
        $this->sortBy = 'relevant';
        $this->timeFilter = '';
        $this->resetPage();
    }

    public function showDetails($jobId)
    {
        $this->selectedJob = JobPost::find($jobId);
    }

    public function updatedProfilePicture()
    {
        $this->validate([
            'profilePicture' => 'image|max:2048',
        ]);

        try {
            $user = Auth::user();

            if ($user->user_image) {
                Storage::disk('public')->delete($user->user_image);
            }

            $imagePath = $this->profilePicture->store('profile-pictures', 'public');

            $manager = new ImageManager(new GdDriver());
            $resizedImage = $manager->read(Storage::disk('public')->path($imagePath))->scale(width: 300);
            $resizedImage->save(Storage::disk('public')->path($imagePath));

            $user->update([
                'user_image' => $imagePath,
            ]);

            session()->flash('message', 'تم تحديث صورة الملف الشخصي بنجاح.');
        } catch (\Exception $e) {
            session()->flash('error', 'حدث خطأ أثناء تحديث صورة الملف الشخصي: ' . $e->getMessage());
        }
    }

    public function render()
    {
        $query = JobPost::query();

        if ($this->timeFilter == '24h') {
            $query->where('created_at', '>=', now()->subDay());
        } elseif ($this->timeFilter == 'week') {
            $query->where('created_at', '>=', now()->subWeek());
        }

        if ($this->sortBy === 'newest') {
            $query->latest();
        }

        $jobs = $query->paginate(10);

        return view('livewire.job-list', [
            'jobs' => $jobs,
        ]);
    }
}
