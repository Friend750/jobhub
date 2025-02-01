<?php

namespace App\Livewire\Dashboard;

use App\Models\JobPost;
use Livewire\Component;
use Livewire\WithPagination;

class JobsTable extends Component
{
    use WithPagination;

    public $search = '';
    public $sortBy = 'created_at';
    public $sortDirection = 'desc';
    public $status = '';
    public $per_page = 5;

    public $about_job, $job_tasks, $job_conditions, $job_skills;
    public $editingJob = null;
    public $viewingJob = null;
    public $job_title, $job_location, $job_timing, $tags, $creator_name;

    public $columns = [
        ['name' => 'job_title', 'display_name' => 'Job Title'],
        ['name' => 'creator', 'display_name' => 'Creator'],
        ['name' => 'job_location', 'display_name' => 'Location'],
        ['name' => 'job_timing', 'display_name' => 'Timing'],
        ['name' => 'tags', 'display_name' => 'Tags'],
        ['name' => 'created_at', 'display_name' => 'Posted On'],
    ];

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function setSortBy($fieldName)
    {
        if ($this->sortBy === $fieldName) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
            return;
        }
        $this->sortBy = $fieldName;
        $this->sortDirection = 'desc';
    }

    public function edit(JobPost $job)
    {
        $this->editingJob = $job->id;
        $this->job_title = $job->job_title;
        $this->job_location = $job->job_location;
        $this->job_timing = $job->job_timing;
        $this->tags = is_array(json_decode($job->tags)) ? implode(', ', json_decode($job->tags)) : '';
        $this->creator_name = optional($job->creator)->name ?? 'N/A';
    }

    public function view($jobId)
    {
        $job = JobPost::with('creator')->find($jobId);
        
        if ($job) {
            $this->viewingJob = $job;
            $this->job_title = $job->job_title;
            $this->job_location = $job->job_location;
            $this->job_timing = $job->job_timing;
            $this->tags = json_decode($job->tags);
            $this->creator_name = optional($job->creator)->user_name ?? 'N/A';

            $this->about_job = $job->about_job ?? 'غير متوفر';
            $this->job_tasks = $job->job_tasks ?? 'غير متوفر';
            $this->job_conditions = $job->job_conditions ?? 'غير متوفر';
            $this->job_skills = $job->job_skills ?? 'غير متوفر';
        }
    }

    public function closeView()
    {
        $this->viewingJob = null;
    }

    public function update()
    {
        $job = JobPost::find($this->editingJob);

        if ($job) {
            $this->validate([
                'job_title' => 'required|string|max:255',
                'job_location' => 'required|string|max:255',
                'job_timing' => 'required|string|max:255',
                'tags' => 'required|array',
            ]);

            $job->update([
                'job_title' => $this->job_title,
                'job_location' => $this->job_location,
                'job_timing' => $this->job_timing,
                'tags' => json_encode($this->tags),
            ]);

            session()->flash('message', 'Job updated successfully.');
        }

        $this->editingJob = null;
    }

    public function delete($jobId)
    {
        $job = JobPost::find($jobId);

        if (!$job) {
            session()->flash('error', 'Job not found or already deleted.');
            return;
        }

        $job->delete();
        session()->flash('message', 'Job deleted successfully.');
    }

    public function render()
    {
        return view('livewire.dashboard.jobs-table', [
            'jobPosts' => JobPost::with('creator')
                ->when($this->search, function ($query) {
                    $query->where('job_title', 'like', "%{$this->search}%");
                })
                ->when($this->status, function ($query) {
                    $query->where('is_active', $this->status === 'active');
                })
                ->orderBy($this->sortBy, $this->sortDirection)
                ->paginate($this->per_page),
        ]);
    }
}
