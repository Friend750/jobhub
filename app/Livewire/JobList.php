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

    protected $jobs;

    public function mount()
    {
        $this->jobs = JobPost::select(
            'user_id',
            'job_title',
            'about_job',
            'job_tasks',
            'job_conditions',
            'job_skills',
            'job_location',
            'job_timing',
            'tags',
            'target',
            'is_active',
            'job_post',
        )
            ->with([
                'user' => fn($q) => $q->select('id', 'user_image'),
                'user.personal_details' => fn($q) => $q->select('user_id', 'first_name', 'last_name', 'specialist')
            ])
            ->where('is_active', 1)
            ->latest()
            ->paginate(10);
    }

    public function render()
    {
        return view('livewire.job-list');
    }
}
