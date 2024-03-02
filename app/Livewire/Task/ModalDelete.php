<?php

namespace App\Livewire\Task;

use Livewire\Component;
use App\Models\Task;
use Livewire\Attributes\On; 

class ModalDelete extends Component
{

    public $taskId;

    public function render()
    {
        return view('livewire.task.modal-delete');
    }

    #[On('eventConfirm')] 
    public function eventConfirm($taskId){
        $this->taskId = $taskId;
    }

    public function delete(){
        $task = Task::find($this->taskId);

        $task->delete();

        $this->dispatch('refresh')->to('task.index');
        $this->dispatch('modalClose', '#modal-delete');
    }
}
