<?php

namespace App\Livewire\Task;

use App\Models\Task;
use Livewire\Component;
use App\Models\TaskStatus;
use Livewire\Attributes\On; 

class ModalDataTo extends Component
{
    public $taskStatuses;

    public $taskId;
    public $name;
    public $description;
    public $deadline;
    public $taskStatusId;

    public $action;

    public function mount(){
        //$this->taskStatuses = TaskStatus::all();         
    }

    public function render()
    {
        return view('livewire.task.modal-data-to');
    }

    #[On('eventAction')] 
    public function eventAction($action, $taskId = ''){
        $this->action = $action;

        if($taskId){
            $this->edit($taskId);
        }
    }

    public function submit(){
;       $this->createOrUpdate();
    }

    public function createOrUpdate(){
        Task::updateOrCreate([
            'id' => $this->taskId
            ],
            [
                'name' => $this->name,
                'description' =>$this->description,
                'deadline' => $this->deadline,
                'task_status_id' => $this->taskStatusId
            ]
        );

        $this->dispatch('refresh')->to('task.index');
        $this->dispatch('modalClose', '#modal-data-to');
        $this->reset();
    }

    private function edit($taskId){

    }

}
