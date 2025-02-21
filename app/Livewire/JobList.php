<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\JobPost;

class JobList extends Component
{
    use WithPagination; // تمكين الترقيم في Livewire

    public $sortBy = 'relevant'; // معيار الفرز الافتراضي
    public $timeFilter = ''; // فلترة الوقت
    public $selectedJob = null; // خاصية لتخزين الوظيفة المحددة

    protected $listeners = ['jobAdded' => '$refresh']; // تحديث القائمة تلقائيًا

    public function updatingSortBy()
    {
        $this->resetPage(); // إعادة تعيين الصفحة عند تغيير الفرز
    }

    public function updatingTimeFilter()
    {
        $this->resetPage(); // إعادة تعيين الصفحة عند تغيير الفلترة
    }

    public function resetFilters()
    {
        $this->sortBy = 'relevant';
        $this->timeFilter = '';
        $this->resetPage();
    }

    public function showDetails($jobId)
    {
        // تحميل تفاصيل الوظيفة المحددة
        $this->selectedJob = JobPost::find($jobId);
    }

    public function render()
    {
        $query = JobPost::latest(); // ترتيب الوظائف حسب الأحدث

        // تطبيق فلترة الوقت
        if ($this->timeFilter == '24h') {
            $query->where('created_at', '>=', now()->subDay());
        } elseif ($this->timeFilter == 'week') {
            $query->where('created_at', '>=', now()->subWeek());
        }

        $jobs = $query->paginate(10); // تقسيم الصفحات إلى 10 وظائف لكل صفحة

        return view('livewire.job-list', ['jobs' => $jobs]);
    }
}
