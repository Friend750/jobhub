<?php
namespace App\Livewire\Forms;

use App\Models\JobPost;
use Livewire\Attributes\Rule;
use Livewire\Form;
use Illuminate\Support\Facades\Auth;

class JobOfferForm extends Form
{
    #[Rule('required|string|max:255')]
    public $job_title = "";

    #[Rule('required|string')]
    public $about_job = "";

    #[Rule('required|string')]
    public $job_tasks = "";

    #[Rule('required|string')]
    public $job_conditions = "";

    #[Rule('required|string')]
    public $job_skills = "";

    #[Rule('required|string|max:255')]
    public $job_location = "";

    #[Rule('required|string|max:255')]
    public $job_timing = "";

    public $tags = [];

    public function submit($target)
    {
        $this->validate();

        $job = JobPost::create([
            'user_id' => Auth::id(),
            'job_title' => $this->job_title,
            'about_job' => $this->about_job,
            'job_tasks' => $this->job_tasks,
            'job_conditions' => $this->job_conditions,
            'job_skills' => $this->job_skills,
            'job_location' => $this->job_location,
            'job_timing' => $this->job_timing,
            'tags' => $this->tags,
            'target' => $target,
        ]);

        // dd($job); // يمكن إزالة هذا السطر إذا لم يكن ضرورياً للتdebug

        // إعادة تعيين الحقول بعد الإرسال
        $this->reset();
        $this->tags = [];
    }
}
