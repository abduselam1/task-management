<?php

namespace App\Http\Livewire\Task;

use App\Models\Task;
use App\Models\Project;
use Livewire\Component;
use Filament\Notifications\Notification;

class Index extends Component
{

    public $tasks;
    public $showCreateTask = false;
    public $name = '';
    public $editName = '';
    public $project;
    public $showEdit = false;
    public $showDelete = false;
    public $listeners = ['updateTask'];


    public function submit()
    {
        // dd($this->project);
        $listPriority = Task::where('product_id',$this->product['id'])->max('priority') ?? 0;
        Task::create([
            'name' => $this->name,
            'project_id' => $this->project['id'],
            'priority' => $listPriority+1
        ]);

        $this->name = '';
        $this->tasks = Task::where('project_id',$this->project['id'])->orderBy('priority', 'asc')->get();
        $this->showCreateTask = false;
        Notification::make()
        ->title('Task created successfully')
        ->success()
        ->send(); 
    }

    public function updateTaskOrder($tasks){
        foreach ($tasks as $orderedTask) {
            $task = Task::find($orderedTask['value']);
            if($task){
                $task->update([
                    'priority' => $orderedTask['order']
                ]);
            }
        }

        $this->updateTask();
        // $this->tasks = $this->project->tasks()->orderBy('priority', 'asc')->get();
        
    }

    public function updateTask()
    {
        $this->tasks = null;
        $this->tasks = Task::where('project_id',$this->project['id'])->orderBy('priority', 'asc')->get();
    }


    
    public function mount(Project $project)
    {
        $this->project = $project;
        $this->tasks = $project->tasks()->orderBy('priority','asc')->get();

    }

    public function render()
    {
        return view('livewire.task.index');
    }
}