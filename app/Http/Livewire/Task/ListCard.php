<?php

namespace App\Http\Livewire\Task;

use App\Models\Task;
use Filament\Notifications\Notification;
use Livewire\Component;

class ListCard extends Component
{
    public $showEdit = false;
    public $showDelete = false;
    public $task;
    public $name = '';

    public function delete()
    {
        $this->task->delete();

        Notification::make()
        ->title('Task deleted.')
        ->success()
        ->send();
        $this->showDelete = false;
        $this->emit('updateTask');

    }

    public function edit()
    {
        $this->validate([
            'name' => 'required'
        ]);

        $this->task->update([
            'name' => $this->name
        ]);

        Notification::make()
        ->title('Task updated.')
        ->success()
        ->send();
        $this->showEdit = false;
        $this->emit('updateTask');
    }
    

    public function mount(Task $task)
    {
        $this->task = $task;
        $this->name = $task->name;
    }



    public function render()
    {
        return view('livewire.task.list-card');
    }
}
