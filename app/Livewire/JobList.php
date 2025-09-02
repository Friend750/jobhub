<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver as GdDriver;
use App\Models\JobPost;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class JobList extends Component
{
    use WithPagination;

    public $allJobs;
    public $initialJob = null;
    public $search = '';
    public $relative = '';
    public $time = '';
    public $gov = '';
    public $id; // this is will auto recieve from the route
    public $UserID;
    public $isShowAllJobs = false;

    public $perPage = 10;

    public function loadMore()
    {
        $this->perPage += 10;

    }

    public function mount($UserID = null)
    {
        $this->UserID = $UserID;
        $this->isShowAllJobs = request()->routeIs('ShowAllJobs');
    }
    public function render()
    {
        $jobs = JobPost::search($this->search)
            ->with([
                'user' => fn($q) => $q->select('id', 'user_image', 'user_name', 'email'),
                'user.personal_details' => fn($q) => $q->select('user_id', 'first_name', 'last_name', 'specialist', 'page_name'),
            ])
            ->withCount('jobLikes')
            ->where('is_active', 1)
            ->when($this->isShowAllJobs, function ($query) {
                $userId = $this->UserID ?: Auth::id();
                return $query->where('user_id', $userId);
            })
            ->when($this->time, function ($q) {
                return match ($this->time) {
                    'هذا الاسبوع' => $q->where('created_at', '>=', Carbon::now()->subDays(7)),
                    'هذا الشهر' => $q->where('created_at', '>=', Carbon::now()->startOfMonth()),
                    default => $q,
                };
            })
            ->when($this->gov && $this->gov !== 'كل المحافظات', function ($query) {
                return $query->where(function ($q) {
                    $q->where('job_location', 'like', "%{$this->gov}%");
                });
            })

            ->when($this->relative, function ($query) {
                return match ($this->relative) {
                    'related' => $query->whereIn('tags', Auth::user()->interests),
                    'views' => $query->orderBy('views', 'desc'),
                    'likes' => $query->orderBy('job_likes_count', 'desc'),
                    'my_jobs' => $query->where('user_id', Auth::id()),
                    default => $query,
                };
            })
            ->latest()
            ->paginate($this->perPage);

        // Ensure a default job is selected
        if ($this->id) {
            $this->initialJob = $jobs->firstWhere('id', $this->id);
        } elseif (!$this->initialJob && $jobs->count()) {
            $this->initialJob = null; // fallback
        }

        return view('livewire.job-list', [
            'jobs' => $jobs,
            'initialJob' => $this->initialJob,
        ]);
    }

}
