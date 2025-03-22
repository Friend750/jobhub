<?php

namespace App\Livewire\Forms;

use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ProjectsForm extends Form
{

    #[Rule([
        'projects.*.title' => 'required|string|max:255',
        'projects.*.description' => 'required|string|max:1000',
        'projects.*.contributions' => 'required|string|max:1000',
    ])]

    public $projects = [
        [
            'title' => '',
            'description' => '',
            'contributions' => '',
        ]
    ];

    protected $messages = [
        'projects.*.title.required' => 'The project :position title is required.',
        'projects.*.description.required' => 'The project :position description is required.',
        'projects.*.contributions.required' => 'The project :position contributions are required.',
    ];

    public function addRow()
    {
        $this->projects[] = ['title' => '', 'description' => '', 'contributions' => ''];
    }

    public function removeRow($index)
    {
        unset($this->projects[$index]);
        $this->projects = array_values($this->projects);
    }

    public $ProjectId = null;
    public function oldData(Project $project)
    {
        $this->projects = [
            [
                'title' => $project->title ?? '',
                'description' => $project->description ?? '',
                'contributions' => $project->contributions ?? '',
            ]
        ];
        $this->ProjectId = $project->id;
    }

    public function deleteProject()
    {
        $project = Project::find($this->ProjectId);

        if ($project && $project->user_id === Auth::id()) {
            $project->delete();
            session()->flash('ProjectMsg', 'The Project has been deleted.');
        } else {
            session()->flash('ProjectMsg', 'You are not authorized to delete this project or it does not exist.');
        }

        $this->reset('ProjectId');
    }

    public function submit()
    {
        $validated = $this->validate();
        foreach ($validated['projects'] as $project) {
            Project::updateOrCreate([
                'id' => $this->ProjectId,
                'user_id' => Auth::id(),
            ], [
                'user_id' => Auth::id(),
                'title' => $project['title'],
                'description' => $project['description'],
                'contributions' => $project['contributions'],
            ]);
        }
    }
}
