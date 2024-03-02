<?php

namespace App\Livewire\Task;

use Livewire\Component;
use App\Models\Task;
use Livewire\Attributes\On; 

class Index extends Component
{
    public $task;

    #[On('refresh')] 
    public function render()
    {
        return view('livewire.task.index', [
            'tasks' => Task::all(),
        ]);
    }
}
