<?php

namespace App\Livewire;

use Livewire\Attributes\Title;
use Livewire\Component;

class JobScreen extends Component
{
    #[Title('Jobs')]

    public $jobs;
    public $selectedJob;

    public function mount()
    {
        $this->jobs = [
            [
                'id' => 1,
                'title' => 'DevOps Engineer',
                'company' => 'GitHub',
                'location' => 'San Francisco, CA',
                'description' => "GitHub helps companies build better software. We're looking for a DevOps Engineer to join our team.",
                'time' => '13 hours ago',
                'applicants' => 'Among the first 25 applicants',
                'photo' => 'https://via.placeholder.com/50',
            ],
            [
                'id' => 2,
                'title' => 'DevOps Engineer',
                'company' => 'PayPal',
                'location' => 'San Francisco, CA',
                'description' => 'PayPal is looking for a DevOps Engineer to enhance our payment systems. Join us now.',
                'time' => '1 week ago',
                'applicants' => 'Among the first applicants',
                'photo' => 'https://via.placeholder.com/50',
            ],
            [
                'id' => 3,
                'title' => 'Infrastructure Engineer',
                'company' => 'PepsiCo',
                'location' => 'Remote',
                'description' => "Join PepsiCo's team to build and maintain infrastructure for global operations.",
                'time' => '8 hours ago',
                'applicants' => 'Among the first applicants',
                'photo' => 'https://via.placeholder.com/50',
            ],
            [
                'id' => 4,
                'title' => 'Software Engineer',
                'company' => 'Google',
                'location' => 'Mountain View, CA',
                'description' => 'Google is looking for a Software Engineer to help build and maintain our search engine infrastructure.',
                'time' => '3 days ago',
                'applicants' => 'Among the first applicants',
                'photo' => 'https://via.placeholder.com/50',
            ],
            [
                'id' => 5,
                'title' => 'Frontend Developer',
                'company' => 'Facebook',
                'location' => 'Menlo Park, CA',
                'description' => 'Facebook is looking for a Frontend Developer to help build and maintain our React-based frontend.',
                'time' => '1 day ago',
                'applicants' => 'Among the first applicants',
                'photo' => 'https://via.placeholder.com/50',
            ],
            [
                'id' => 6,
                'title' => 'Backend Developer',
                'company' => 'Instagram',
                'location' => 'San Francisco, CA',
                'description' => 'Instagram is looking for a Backend Developer to help build and maintain our Node.js-based backend.',
                'time' => '2 weeks ago',
                'applicants' => 'Among the first applicants',
                'photo' => 'https://via.placeholder.com/50',
            ],
        ];

        // Default to the first job
        $this->selectedJob = $this->jobs[0];
    }

    public function selectJob($jobId)
    {
        $this->selectedJob = collect($this->jobs)->firstWhere('id', $jobId);
    }
    public function render()
    {
        return view('livewire.job-screen');
    }
}
