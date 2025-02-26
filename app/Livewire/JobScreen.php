<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Collection;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver as GdDriver;

class JobScreen extends Component
{
    public $jobs;
    public $selectedJob;
    public $profilePicture; // خاصية لتحميل الصورة

    public $sortBy = 'relevant'; // الافتراضي: الأكثر صلة
    public $timeFilter = ''; // الافتراضي: أي وقت

    public function mount()
    {
        // تحميل البيانات الوظيفية (يمكن استبداله بالاستعلام من قاعدة البيانات)
        $this->jobs = collect([
            [
                'id' => 1,
                'title' => 'DevOps Engineer',
                'company' => 'GitHub',
                'location' => 'San Francisco, CA',
                'description' => "GitHub helps companies build better software. We're looking for a DevOps Engineer to join our team.",
                'time' => now()->subHours(13),
                'applicants' => 'Among the first 25 applicants',
                'photo' => 'https://via.placeholder.com/50',
            ],
            // أضف المزيد من الوظائف هنا
        ]);

        // ضبط الوظيفة المحددة افتراضيًا
        $this->selectedJob = $this->jobs->first();
    }

    // اختيار وظيفة معينة
    public function selectJob($jobId)
    {
        $this->selectedJob = $this->jobs->firstWhere('id', $jobId);
    }

    // تصفية وفرز الوظائف
    public function getFilteredJobsProperty()
    {
        return $this->jobs
            ->when($this->timeFilter === '24h', fn($query) => $query->filter(fn($job) => now()->diffInHours($job['time']) <= 24))
            ->when($this->timeFilter === 'week', fn($query) => $query->filter(fn($job) => now()->diffInDays($job['time']) <= 7))
            ->when($this->sortBy === 'newest', fn($query) => $query->sortByDesc('time'))
            ->values(); // لضمان أن الفهرس يبدأ من 0
    }

    // إعادة ضبط الفلاتر
    public function resetFilters()
    {
        $this->sortBy = 'relevant';
        $this->timeFilter = '';
        $this->selectedJob = $this->jobs->first(); // إعادة تعيين الوظيفة المحددة
    }
    
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

    public function render()
    {
        return view('livewire.job-screen', [
            'filteredJobs' => $this->filteredJobs,
        ]);
    }
}
