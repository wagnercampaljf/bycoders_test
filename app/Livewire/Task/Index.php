<?php

namespace App\Livewire\Task;

use Livewire\Component;
use App\Models\Task;
use Livewire\Attributes\On; 
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $task;

    public $nameFilter;
    public $initialDateFilter;
    public $finalDateFilter;

    #[On('refresh')] 
    public function render()
    {
        return view('livewire.task.index', [
            'tasks' => $this->filter(),
        ]);
    }

    public function filter(){
        $tasksQuery = Task::query();
        $tasksQuery->when($this->nameFilter, function ($q, $name){
            return $q->where('name','like', '%'.$name.'%');
        });
        $tasksQuery->when($this->initialDateFilter, function ($q, $initialDateFilter){
            return $q->where('deadline', '>=', $initialDateFilter);
        });
        $tasksQuery->when($this->finalDateFilter, function ($q, $finalDateFilter){
            $finalDateFilter .= ' 23:59:59';
            return $q->where('deadline', '<=', $finalDateFilter);
        });

        return $tasksQuery->paginate(5);
        
    }

    public function cleanFilter(){
        $this->nameFilter = null;
        $this->initialDateFilter = null;
        $this->finalDateFilter = null;

        $this->dispatch('refresh')->to('task.index');
    }
}
