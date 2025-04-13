<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\JobPost;
use Illuminate\Validation\Rule;

class JobsTable extends Component
{
    use WithPagination;

    // Pagination and filtering
    public $search = '';
    public $status = '';
    public $per_page = 10;

    // Modal control
    public $showModal = false;
    public $modalType = 'view';
    public $showDeleteModal = false;

    // Selected job
    public $selectedJob = [
        'id' => null,
        'job_title' => '',
        'job_location' => '',
        'about_job' => '',
        'job_tasks' => '',
        'job_conditions' => '',
        'job_skills' => '',
        'tags' => [],
        'is_active' => false
    ];
    
    public $deleteJobId;
    public $deleteJobTitle;

    protected $queryString = [
        'search' => ['except' => '', 'as' => 'q'],
        'status' => ['except' => '', 'as' => 's'],
        'per_page' => ['except' => 10, 'as' => 'pp']
    ];

    protected $listeners = [
        'jobUpdated' => '$refresh',
        'closeModal' => 'closeModal',
    ];

    public function resetFilters()
    {
        $this->reset(['search', 'status', 'per_page']);
        $this->resetPage();
    }

    public function updated($property)
    {
        if (in_array($property, ['search', 'status', 'per_page'])) {
            $this->resetPage();
        }
    }

    public function updateStatus($jobId, $status)
    {
        JobPost::where('id', $jobId)->update(['is_active' => $status]);
        $this->dispatch('notify', 
            type: 'success',
            message: 'تم تحديث حالة الوظيفة بنجاح'
        );
    }
    
    public function view($jobId)
    {
        try {
            $job = JobPost::findOrFail($jobId);
            
            $this->selectedJob = [
                'id' => $job->id,
                'job_title' => $job->job_title,
                'job_location' => $job->job_location,
                'about_job' => $job->about_job,
                'job_tasks' => $job->job_tasks,
                'job_conditions' => $job->job_conditions,
                'job_skills' => $job->job_skills,
                'tags' => $this->parseTags($job->tags),
                'is_active' => (bool)$job->is_active
            ];
            
            $this->modalType = 'view';
            $this->showModal = true;
            
        } catch (\Exception $e) {
            $this->dispatch('notify', 
                type: 'error',
                message: 'حدث خطأ أثناء تحميل البيانات: ' . $e->getMessage()
            );
        }
    }

    public function edit($jobId)
    {
        try {
            $job = JobPost::findOrFail($jobId);
            
            $this->selectedJob = [
                'id' => $job->id,
                'job_title' => $job->job_title,
                'job_location' => $job->job_location,
                'about_job' => $job->about_job,
                'job_tasks' => $job->job_tasks,
                'job_conditions' => $job->job_conditions,
                'job_skills' => $job->job_skills,
                'tags' => $this->parseTags($job->tags),
                'is_active' => (bool)$job->is_active
            ];
            
            $this->modalType = 'edit';
            $this->showModal = true;
            
        } catch (\Exception $e) {
            $this->dispatch('notify', 
                type: 'error',
                message: 'حدث خطأ أثناء تحميل البيانات: ' . $e->getMessage()
            );
        }
    }

    private function parseTags($tags)
    {
        if (is_array($tags)) return $tags;
        if (is_string($tags)) {
            $decoded = json_decode($tags, true);
            return is_array($decoded) ? $decoded : [];
        }
        return [];
    }

    public function updateJob()
    {
        $this->validate([
            'selectedJob.job_title' => 'required|string|max:255',
            'selectedJob.job_location' => 'required|string|max:255',
            'selectedJob.about_job' => 'nullable|string',
            'selectedJob.job_tasks' => 'nullable|string',
            'selectedJob.job_conditions' => 'nullable|string',
            'selectedJob.job_skills' => 'nullable|string',
        ]);
        
        try {
            $job = JobPost::findOrFail($this->selectedJob['id']);
            
            $tags = $this->selectedJob['tags'];
            if (!is_array($tags)) {
                $tags = is_string($tags) ? array_map('trim', explode(',', $tags)) : [];
            }
            
            $job->update([
                'job_title' => $this->selectedJob['job_title'],
                'job_location' => $this->selectedJob['job_location'],
                'about_job' => $this->selectedJob['about_job'],
                'job_tasks' => $this->selectedJob['job_tasks'],
                'job_conditions' => $this->selectedJob['job_conditions'],
                'job_skills' => $this->selectedJob['job_skills'],
                'tags' => json_encode(array_unique(array_filter($tags))),
                'is_active' => $this->selectedJob['is_active'] ?? false,
            ]);
            
            $this->dispatch('jobUpdated');
            $this->closeModal();
            $this->dispatch('notify', 
                type: 'success',
                message: 'تم تحديث الوظيفة بنجاح'
            );
            
        } catch (\Exception $e) {
            $this->dispatch('notify', 
                type: 'error',
                message: 'حدث خطأ أثناء التحديث: ' . $e->getMessage()
            );
        }
    }

    public function confirmDelete($jobId)
    {
        try {
            $job = JobPost::findOrFail($jobId);
            $this->deleteJobId = $jobId;
            $this->deleteJobTitle = $job->job_title;
            $this->showDeleteModal = true;
        } catch (\Exception $e) {
            $this->dispatch('notify', 
                type: 'error',
                message: 'حدث خطأ أثناء تحميل البيانات: ' . $e->getMessage()
            );
        }
    }

    public function delete()
    {
        try {
            JobPost::findOrFail($this->deleteJobId)->delete();
            
            $this->showDeleteModal = false;
            $this->dispatch('jobUpdated');
            $this->dispatch('notify', 
                type: 'success',
                message: 'تم حذف الوظيفة بنجاح'
            );
        } catch (\Exception $e) {
            $this->dispatch('notify', 
                type: 'error',
                message: 'حدث خطأ أثناء الحذف: ' . $e->getMessage()
            );
        }
    }

    public function closeModal()
    {
        $this->reset(['selectedJob', 'showModal', 'modalType']);
    }

    public function render()
    {
        $query = JobPost::query()
            ->with('user')
            ->when($this->search, function($query) {
                $query->where(function($q) {
                    $q->where('job_title', 'like', '%'.$this->search.'%')
                      ->orWhere('job_location', 'like', '%'.$this->search.'%')
                      ->orWhere('about_job', 'like', '%'.$this->search.'%')
                      ->orWhere('job_tasks', 'like', '%'.$this->search.'%')
                      ->orWhereJsonContains('tags', $this->search);
                });
            })
            ->when($this->status !== '', function($query) {
                $query->where('is_active', $this->status === 'active');
            })
            ->orderBy('created_at', 'desc');
    
        $jobPosts = $query->paginate($this->per_page);
    
        return view('livewire.dashboard.jobs-table', compact('jobPosts'));
    }
}