<div> 
    <div class="container-fluid px-4">
        <h1 class="mt-4">Tasks</h1>
        <div class="row">
            <div class="card mb-4">
                <div class="card-body">
                    <form>
                        <div class="container">
                            <div class="row">
                                <div class="col">
                                    <div class="mb-4">
                                        <label for="selectStatus" class="form-label">Status</label>
                                        <select wire:model="taskStatusIdFilter" id="selectStatus" class="form-select" aria-label="Default select example">
                                                <option value=></option>
                                                <option value=1>Pending</option>
                                                <option value=2>Completed</option>
                                                <option value=3>Overdue</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="inputInitialDateFilter" class="form-label">Initial Date</label>
                                        <input wire:model="initialDateFilter" type="date" class="form-control" id="inputInitialDateFilter" >
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="inputFinalDateFilter" class="form-label">Final Date</label>
                                        <input wire:model="finalDateFilter" type="date" class="form-control" id="inputFinalDateFilter" >
                                    </div>
                                </div>
                                <div class="col-2 d-flex justify-content-center align-items-center d-grid gap-2">
                                    <button wire:click="dispatch('refresh')" type="button" class="btn btn-primary btn-block">Apply Filter</button>
                                    @if ($taskStatusIdFilter || $initialDateFilter || $finalDateFilter)
                                        <button wire:click="cleanFilter" type="button" class="btn btn-primary btn-block">Clean Filter</button>
                                    @endif
                                </div>
                            </div>        
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-4 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body">Pending</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">Quantity: {{$quantityPending}}</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6">
                <div class="card bg-warning text-white mb-4">
                    <div class="card-body">Overdue</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">Quantity: {{$quantityOverdue}}</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6">
                <div class="card bg-success text-white mb-4">
                    <div class="card-body">Completed</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">Quantity: {{$quantityCompleted}}</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-area me-1"></i>
                        Quantity per Status
                    </div>
                    <div class="card-body">
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-bar me-1"></i>
                        Quantity per day
                    </div>
                    <div class="card-body">
                        <canvas id="myChart2"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    DataTable Example
                </div>
                <div class="card-body">
                    @if ($tasks->isEmpty())
                        <div class="alert alert-secundary text-center mb-0" role="alert">
                            No tasks registered.
                        </div>
                    @else
                    <table class="table table-striped table-hover" style="table-layout: fixed">
                        <thead>
                        <tr class="table-secundary">
                            <th scope="col" class="col-1 d-none d-md-table-cell">ID</th>
                            <th scope="col" class="col-2">Name</th>
                            <th scope="col" class="col-5 d-none d-md-table-cell">Description</th>
                            <th scope="col" class="col-2 d-none d-md-table-cell">Deadline</th>
                            <th scope="col" class="col-2">Status</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($tasks as $task)
                                <tr>
                                    <td scope="row" class="col-1 d-none d-md-table-cell">{{$task->id}}</th>
                                    <td class="col-2">{{$task->name}}</td>
                                    <td class="col-5 d-none d-md-table-cell">{{$task->description}}</td>
                                    <td class="col-2 d-none d-md-table-cell">{{$task->deadline}}</td>
                                    <td class="col-2">{{$task->taskStatus->name}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
    
                    {{$tasks->links()}}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    
    //Chart1
    const ctx = document.getElementById('myChart');

    const myChart1 = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Pending', 'Overduo', 'Complted'],
        datasets: [{
        label: '',
        data: [{!! $quantityPending !!}, {!! $quantityOverdue !!}, {!! $quantityCompleted !!} ],
        borderWidth: 1
        }]
    },
    options: {
        // scales: {
        // y: {
        //     beginAtZero: true
        // }
        // }
    }
    });

    
    //Chart2
    const ctx2 = document.getElementById('myChart2');

    const myChart2 = new Chart(ctx2, {
        type: 'line',
        data: {
            labels: {!! json_encode($chartLineLabels) !!},
            datasets: [{
                label: 'Pending',
                data: {!! json_encode($chartLineDataPending) !!},
                fill: false,
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.1
            },
            {
                label: 'Overduo',
                data: {!! json_encode($chartLineDataOverduo) !!},
                fill: false,
                borderColor: 'rgb(100, 100, 100)',
                tension: 0.1
            },
            {
                label: 'Completed',
                data: {!! json_encode($chartLineDataCompleted) !!},
                fill: false,
                borderColor: 'rgb(200, 150, 50)',
                tension: 0.1
            }]
        }
    });

    document.addEventListener('livewire:init', function () {
            Livewire.on('chartDataUpdated', function (data) {
                // Atualizar os dados do gráfico
                myChart1.data.datasets[0].data = [data[0].quantityPending, data[0].quantityOverdue, data[0].quantityCompleted ];

                myChart1.options.plugins.title.text = 'new title';

                myChart1.update();
            });

            Livewire.on('chartDataUpdatedLine', function (data) {
                // Atualizar os dados do gráfico
                myChart2.data.labels = data[0].chartLineLabels;
                myChart2.data.datasets[0].data = data[0].chartLineDataPending;
                myChart2.data.datasets[1].data = data[0].chartLineDataOverduo;
                myChart2.data.datasets[2].data = data[0].chartLineDataCompleted;

                myChart2.update();
            });
        });

</script>
