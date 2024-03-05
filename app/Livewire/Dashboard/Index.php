<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Task;
use Livewire\Attributes\On; 
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $task;

    public $taskStatusIdFilter;
    public $initialDateFilter = '2024-03-01';
    public $finalDateFilter = '2024-03-15';

    public $data_chart2 = [10, 20, 30, 40, 50, 60, 70];

    public $quantityPending = 5;
    public $quantityOverdue = 15;
    public $quantityCompleted = 25;

    public $chartLineLabels;
    public $chartLineDataPending;
    public $chartLineDataOverduo;
    public $chartLineDataCompleted;    

    #[On('refresh')] 
    public function render()
    {
        $this->getQuantityPending();
        $this->getQuantityOverdue();
        $this->getQuantityCompleted();

        $this->getChartLineLabels();
        $this->chartLineDataPending = $this->getChartLineData(1);
        $this->chartLineDataOverduo = $this->getChartLineData(2);
        $this->chartLineDataCompleted = $this->getChartLineData(3);

        return view('livewire.dashboard.index', [
            'tasks' => $this->filter(),
        ]);
    }

    #[On('chartCreate')] 
    public function createChart()
    {
        $this->dispatch('createChart');
    }

    public function getQuantityPending(){
        $tasksQuery = Task::query();
        $tasksQuery->when($this->initialDateFilter, function ($q, $initialDateFilter){
            return $q->where('deadline', '>=', $initialDateFilter);
        });
        $tasksQuery->when($this->finalDateFilter, function ($q, $finalDateFilter){
            $finalDateFilter .= ' 23:59:59';
            return $q->where('deadline', '<=', $finalDateFilter);
        });
        $tasksQuery->where('task_status_id', 1);

        $this->quantityPending = $tasksQuery->count();
    }

    public function getQuantityOverdue(){
        $tasksQuery = Task::query();
        $tasksQuery->when($this->initialDateFilter, function ($q, $initialDateFilter){
            return $q->where('deadline', '>=', $initialDateFilter);
        });
        $tasksQuery->when($this->finalDateFilter, function ($q, $finalDateFilter){
            $finalDateFilter .= ' 23:59:59';
            return $q->where('deadline', '<=', $finalDateFilter);
        });
        $tasksQuery->where('task_status_id', 2);

        $this->quantityOverdue = $tasksQuery->count();
    }
    
    public function getQuantityCompleted(){
        $tasksQuery = Task::query();
        $tasksQuery->when($this->initialDateFilter, function ($q, $initialDateFilter){
            return $q->where('deadline', '>=', $initialDateFilter);
        });
        $tasksQuery->when($this->finalDateFilter, function ($q, $finalDateFilter){
            $finalDateFilter .= ' 23:59:59';
            return $q->where('deadline', '<=', $finalDateFilter);
        });
        $tasksQuery->where('task_status_id', 3);

        $this->quantityCompleted = $tasksQuery->count();
    }

    public function filter(){
        $tasksQuery = Task::query();
        $tasksQuery->when($this->taskStatusIdFilter, function ($q, $taskStatusIdFilter){
            return $q->where('task_status_id','=', $taskStatusIdFilter);
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
        $this->taskStatusIdFilter = null;
        $this->initialDateFilter = null;
        $this->finalDateFilter = null;

        $this->dispatch('refresh')->to('dashboard.index');
    }

    public function getChartLineLabels(){
        if (!empty($this->initialDateFilter) && !empty($this->finalDateFilter)){             
            $this->chartLineLabels = $this->generateDatesBetween($this->initialDateFilter, $this->finalDateFilter);
        }
    }

    public function getChartLineData(int $taskStatusId){
        $data = [];
        foreach($this->chartLineLabels as $label){
            $tasksQuery = Task::query();
            $tasksQuery->where('deadline', '>=', $label);
            $finalDateFilter = $label.' 23:59:59';
            $tasksQuery->where('deadline', '<=', $finalDateFilter);
            $tasksQuery->where('task_status_id', $taskStatusId);

            $data[] = $tasksQuery->count();
        }

        return $data;
    }
    
    function generateDatesBetween($startDate, $endDate)
    {
        $dates = [];
        $currentDate = strtotime($startDate);
    
        while ($currentDate <= strtotime($endDate)) {
            $dates[] = date('Y-m-d', $currentDate);
            $currentDate = strtotime('+1 day', $currentDate);
        }
    
        return $dates;
    }


}