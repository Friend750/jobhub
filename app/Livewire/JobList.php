<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver as GdDriver;
use App\Models\JobPost;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class JobList extends Component
{
    use WithPagination;

    public $jobs;
    public $initialJob = null;
    public $search = '';
    public $relative = '';
    public $time = '';
    public $gov = '';
    public $id; // this is will auto recieve from the route
    public function render()
    {
        $this->jobs = JobPost::search($this->search)
            ->with([
                'user' => fn($q) => $q->select('id', 'user_image', 'user_name'),
                'user.personal_details' => fn($q) => $q->select('user_id', 'first_name', 'last_name', 'specialist', 'page_name')
            ])
            ->where('is_active', 1)
            ->when($this->time, function ($q) {
                return match ($this->time) {
                    'هذا الاسبوع' => $q->where('created_at', '>=', Carbon::now()->subDays(7)),
                    'هذا الشهر' => $q->where('created_at', '>=', Carbon::now()->startOfMonth()),
                    default => $q,
                };
            })
            ->when($this->gov, function ($query){
                return $query->where('job_location', 'like', "%{$this->gov}%");
            })
            ->latest()
            ->get()
            ->when($this->id, fn($collection) => $collection->sortBy(
                fn($job) => $job->id == $this->id ? 0 : 1
            ));

        if ($this->id) {
            $this->initialJob = $this->jobs->firstWhere('id', $this->id);
        }

        // dump(JobPost::find(58));
        return view('livewire.job-list');
    }
}
