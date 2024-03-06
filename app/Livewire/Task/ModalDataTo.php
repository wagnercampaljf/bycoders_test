<?php

namespace App\Livewire\Task;

use App\Models\Task;
use Livewire\Component;
use App\Models\TaskStatus;
use App\Notifications\TaskChange;
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

    protected $rules = [
        'name' => 'required|max:255',
        'description' => 'max:5000',
        'deadline' => 'required',
        'taskStatusId' => 'required'
    ];

    protected $messages = [
        'taskStatusId.required' => 'The status field is required.'
    ];

    public function mount(){
        //$this->taskStatuses = TaskStatus::all();         
    }

    public function render()
    {
        return view('livewire.task.modal-data-to');
    }

    #[On('eventAction')] 
    public function eventAction($action, $taskId = ''){
        $this->reset();

        $this->action = $action;

        if($taskId){
            $this->edit($taskId);
        }
    }

    public function submit(){
        $this->validate();

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

        #broadcast 
        $user = auth()->user();
        $user->notify(new TaskChange($user));
    }

    private function edit($taskId){
        $task = Task::find($taskId);

        $this->taskId = $task->id;
        $this->name = $task->name;
        $this->description = $task->description;
        $this->deadline = $task->deadline;
        $this->taskStatusId = $task->task_status_id;
    }

}
