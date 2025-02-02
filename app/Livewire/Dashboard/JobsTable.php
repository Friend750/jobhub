<?php


namespace App\Livewire\Dashboard;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\JobPost;

class JobsTable extends Component
{
    use WithPagination;

    public $search = '';
    public $status = '';
    public $per_page = 5;
    public $selectedJob = null;
    public $editMode = false;

    public $showDetails = false; // للتحكم في إظهار الكارد

    protected $queryString = ['search', 'status', 'per_page'];
    protected $listeners = ['jobDeleted' => '$refresh'];

    
    public function view($jobId)
    {
        $this->selectedJob = JobPost::findOrFail($jobId);
        $this->showDetails = true; // عرض الكارد عند الضغط
    }

    public function closeView()
    {
        $this->showDetails = false; // إخفاء الكارد
    }

    public function edit($jobId)
    {
        $this->selectedJob = JobPost::findOrFail($jobId);
        $this->editMode = true;
        $this->dispatch('show-edit-modal');
    }

    public function updateJob()
    {
        $this->validate([
            'selectedJob.job_title' => 'required|string|max:255',
            'selectedJob.job_location' => 'required|string|max:255',
        ]);

        $this->selectedJob->save();
        $this->editMode = false;
        $this->dispatch('hide-edit-modal');
        session()->flash('message', 'Job updated successfully!');
    }

    public function delete($jobId)
    {
        JobPost::findOrFail($jobId)->delete();
        $this->dispatch('jobDeleted');
        session()->flash('message', 'Job deleted successfully!');
    }

    public function render()
    {
        $jobPosts = JobPost::with('user')
            ->search($this->search)
            ->when($this->status !== '', function ($query) {
                return $query->where('is_active', $this->status === 'active');
            })
            ->paginate($this->per_page);

        return view('livewire.dashboard.jobs-table', compact('jobPosts'));
    }
}
