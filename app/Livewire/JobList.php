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

    public $jobs;
    public $initialJob = null;
    public function mount($id = null)
    {
        $this->jobs = JobPost::select(
            'id',
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
            'created_at',
        )
            ->with([
                'user' => fn($q) => $q->select('id', 'user_image', 'user_name'),
                'user.personal_details' => fn($q) => $q->select('user_id', 'first_name', 'last_name', 'specialist', 'page_name')
            ])
            ->where('is_active', 1)
            ->latest()
            ->get()
            ->when($id, fn($collection) => $collection->sortBy(
                fn($job) => $job->id == $id ? 0 : 1
            ));


        if ($id) {
            $this->initialJob = $this->jobs->firstWhere('id', $id);
        }

    }
    public function render()
    {
        return view('livewire.job-list');
    }
}
