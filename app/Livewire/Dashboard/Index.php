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

    public $taskStatusIdFilter;
    public $initialDateFilter;
    public $finalDateFilter;

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
        $this->getChartData();

        return view('livewire.dashboard.index', [
            'tasks' => $this->filter(),
        ]);
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

        $this->dispatch('refresh')->to('dashboard');
    }

    public function getChartLineLabels(){
        if (!empty($this->initialDateFilter) && !empty($this->finalDateFilter)){             
            $this->chartLineLabels = $this->generateDatesBetween($this->initialDateFilter, $this->finalDateFilter);
        }
        elseif (empty($this->initialDateFilter) && !empty($this->finalDateFilter)){  
            $firstDate = Task::orderBy('deadline', 'asc')->first()->deadline;
            $this->chartLineLabels = $this->generateDatesBetween($firstDate, $this->finalDateFilter);
        } 
        elseif (!empty($this->initialDateFilter) && empty($this->finalDateFilter)){  
            $lastDate = Task::orderBy('deadline', 'desc')->first()->deadline;
            $lastDate = substr($lastDate, 0, 10).' 23:59:59';
            $this->chartLineLabels = $this->generateDatesBetween($this->initialDateFilter, $lastDate);
        }  
        else{
            $firstDate = Task::orderBy('deadline', 'asc')->first()->deadline; 
            $lastDate = Task::orderBy('deadline', 'desc')->first()->deadline;
            $lastDate = substr($lastDate, 0, 10).' 23:59:59';
            $this->chartLineLabels = $this->generateDatesBetween($firstDate, $lastDate);
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

    #[On('updateChart')] 
    public function updateChartData()
    {
        $this->dispatch('chartDataUpdated', [
            'quantityPending' => $this->quantityPending,
            'quantityOverdue' => $this->quantityOverdue,
            'quantityCompleted' => $this->quantityCompleted,
        ]);
    }

    #[On('updateChartLine')] 
    public function updateChartDataLine()
    {
        $this->dispatch('chartDataUpdatedLine', [
            'chartLineLabels' => $this->chartLineLabels,
            'chartLineDataPending' => $this->chartLineDataPending,
            'chartLineDataOverduo' => $this->chartLineDataOverduo,
            'chartLineDataCompleted' => $this->chartLineDataCompleted,
        ]);
    }

    public function getChartData()
    {
        $this->getQuantityPending();
        $this->getQuantityOverdue();
        $this->getQuantityCompleted();
        $this->getChartLineLabels();
        $this->chartLineDataPending = $this->getChartLineData(1);
        $this->chartLineDataOverduo = $this->getChartLineData(2);
        $this->chartLineDataCompleted = $this->getChartLineData(3);

        $this->updateChartData();
        $this->updateChartDataLine();
    }
}