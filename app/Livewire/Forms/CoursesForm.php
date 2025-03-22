<?php

namespace App\Livewire\Forms;

use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CoursesForm extends Form
{
    #[Rule([
        'courses.*.course_name' => 'required|string|max:255',
        'courses.*.institution_name' => 'required|string|max:255',
        'courses.*.end_date' => 'required|date|before_or_equal:today',
    ])]

    public $courses = [
        [
            'course_name' => '',
            'institution_name' => '',
            'end_date' => '',
        ]
    ];

    protected $messages = [
        'courses.*.course_name.required' => 'The course :position name is required.',
        'courses.*.institution_name.required' => 'The institution :position name is required.',
        'courses.*.end_date.required' => 'The end date :position is required.',
        'courses.*.end_date.before_or_equal' => 'The date must be in the past.',
    ];

    public function addRow()
    {
        $this->courses[] = [
            'course_name' => '',
            'institution_name' => '',
            'end_date' => '',
        ];
    }

    public function removeRow($index)
    {
        unset($this->courses[$index]);
        $this->courses = array_values($this->courses);
    }

    public $CourseId = null;

    public function oldData(Course $course)
    {
        $this->courses = [
            [
                'course_name' => $course->course_name ?? '',
                'institution_name' => $course->institution_name ?? '',
                'end_date' => $course->end_date->format('Y-m-d') ?? '',
            ]
        ];
        $this->CourseId = $course->id;
    }

    public function deleteCourse()
    {
        $course = Course::find($this->CourseId);

        if ($course && $course->user_id === Auth::id()) {
            $course->delete();
            session()->flash('CourseMsg', 'The Course has been deleted.');
        } else {
            session()->flash('CourseMsg', 'You are not authorized to delete this course or it does not exist.');
        }

        $this->reset('CourseId');
    }

    public function submit()
    {
        $validated = $this->validate();
        foreach ($validated['courses'] as $course) {
            Course::updateOrCreate([
                'id' => $this->CourseId,
                'user_id' => Auth::id(),
            ], [
                'user_id' => Auth::id(),
                'course_name' => $course['course_name'],
                'institution_name' => $course['institution_name'],
                'end_date' => $course['end_date'],
            ]);
        }
    }
}
