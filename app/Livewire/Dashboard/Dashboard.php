<?php

namespace App\Livewire\Dashboard;

use App\Models\Chat;
use App\Models\JobPost;
use App\Models\Post;
use App\Models\User;
use Livewire\Attributes\Title;
use Livewire\Component;

class Dashboard extends Component
{
    #[Title('Dashboard')]

    public $currentSection = 'home'; // Default section

    public $adminCount;
    public $userCount;
    public $activatedCount;
    public $connectedCount;
    public $postsCount;
    public $messagesCount;

    public $activeJobsCount;
    public $unActiveJobsCount;

    public $commentsCount;
    public $likesCount;
    public function switchSection($section)
    {
        $this->currentSection = $section;
    }

    public function mount()
    {
        $this->adminCount = User::where('type', 'admin')->count();
        $this->userCount = User::where('type', 'user')->count();
        $this->activatedCount = User::where('is_active', true)->count();
        $this->connectedCount = User::where('is_connected', true)->count();
        $this->postsCount = JobPost::get()->count() + Post::get()->count();
        $this->messagesCount = Chat::get()->count();
        $this->activeJobsCount = JobPost::where('is_active', true)->count();
        $this->unActiveJobsCount = JobPost::where('is_active', false)->count();
        $this->commentsCount =  Post::withCount('comments')->get()->sum('comments_count') + JobPost::withCount('comments')->get()->sum('comments_count');
        $this->likesCount = Post::withCount('likes')->get()->sum('likes_count') +  JobPost::withCount('jobLikes')->get()->sum('job_likes_count');
    }

    public function render()
    {
        return view('livewire.dashboard.dashboard');
    }
}
