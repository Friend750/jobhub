<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Collection;

class JobScreen extends Component
{
    public $jobs;
    public $selectedJob;
    public $sortBy = 'relevant'; // الافتراضي: الأكثر صلة
    public $timeFilter = ''; // الافتراضي: أي وقت

    public function mount()
    {
        // تحميل البيانات الوظيفية
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
            [
                'id' => 2,
                'title' => 'DevOps Engineer',
                'company' => 'PayPal',
                'location' => 'San Francisco, CA',
                'description' => 'PayPal is looking for a DevOps Engineer to enhance our payment systems. Join us now.',
                'time' => now()->subDays(7),
                'applicants' => 'Among the first applicants',
                'photo' => 'https://via.placeholder.com/50',
            ],
            [
                'id' => 3,
                'title' => 'Infrastructure Engineer',
                'company' => 'PepsiCo',
                'location' => 'Remote',
                'description' => "Join PepsiCo's team to build and maintain infrastructure for global operations.",
                'time' => now()->subHours(8),
                'applicants' => 'Among the first applicants',
                'photo' => 'https://via.placeholder.com/50',
            ],
            [
                'id' => 4,
                'title' => 'Software Engineer',
                'company' => 'Google',
                'location' => 'Mountain View, CA',
                'description' => 'Google is looking for a Software Engineer to help build and maintain our search engine infrastructure.',
                'time' => now()->subDays(3),
                'applicants' => 'Among the first applicants',
                'photo' => 'https://via.placeholder.com/50',
            ],
            [
                'id' => 5,
                'title' => 'Frontend Developer',
                'company' => 'Facebook',
                'location' => 'Menlo Park, CA',
                'description' => 'Facebook is looking for a Frontend Developer to help build and maintain our React-based frontend.',
                'time' => now()->subDays(1),
                'applicants' => 'Among the first applicants',
                'photo' => 'https://via.placeholder.com/50',
            ],
            [
                'id' => 6,
                'title' => 'Backend Developer',
                'company' => 'Instagram',
                'location' => 'San Francisco, CA',
                'description' => 'Instagram is looking for a Backend Developer to help build and maintain our Node.js-based backend.',
                'time' => now()->subWeeks(2),
                'applicants' => 'Among the first applicants',
                'photo' => 'https://via.placeholder.com/50',
            ],
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
    }

    public function render()
    {
        return view('livewire.job-screen', [
            'filteredJobs' => $this->filteredJobs,
        ]);
    }
}
