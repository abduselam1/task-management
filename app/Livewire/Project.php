<?php

namespace App\Livewire;

use App\Models\Project as ModelsProject;
use Livewire\Component;

class Project extends Component
{
    public $projects;
    public $project = null;
    public $showCreateProject = false;
    public $name;

    public function updateSelectedProject($project = null)
    {
        $this->project = $project;
        // dd($project);
    }

    public function submit()
    {
        $this->validate([
            'name' => 'required'
        ]);

        ModelsProject::create([
            'name' => $this->name,
            'user_id' => auth()->id()
        ]);

        $this->projects = ModelsProject::where('user_id')->get();
        $this->name = '';
        session()->flash('project','Project created successfully');
        $this->showCreateProject = false;

    }

    public function mount()
    {

        $this->projects = ModelsProject::where('user_id',auth()->id())->get();

    }

    public function render()
    {
        return view('livewire.project');
    }
}
