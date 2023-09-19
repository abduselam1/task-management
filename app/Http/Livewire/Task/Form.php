<?php

namespace App\Http\Livewire\Task;

use Livewire\Component;

class Form extends Component
{
    public $name;

    public function render()
    {
        return view('livewire.task.form');
    }
}
