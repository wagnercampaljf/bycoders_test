<div>
    <div class="card offset-1 col-10 mb-2 mt-2">
        <h4 class="card-header">Search Tasks</h4>
        <div class="card-body">
            <form>
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="inputNameFilter" class="form-label">Name</label>
                                <input  wire:model="nameFilter" type="text" class="form-control" id="inputNameFilter">
                            </div>
                        </div>
                    </div>
                    <div class="row">
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
                    </div>
                    <div class="row">
                        <div class="col">
                            <button wire:click="dispatch('refresh')" type="button" class="btn btn-primary">Search</button>
                            @if ($nameFilter || $initialDateFilter || $finalDateFilter)
                                <button wire:click="cleanFilter" type="button" class="btn btn-primary">Clean Filter</button>
                            @endif
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
   
    <div class="card col-12">
        <div class="card-header">
            <div class="container">
                <div class="row align-items-center justify-content-between">
                    <div class="col">
                        <h4>Task List</h4>
                    </div>
                    <div class="col-auto">
                        <button wire:click="dispatch('eventAction', ['store'])" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-data-to">New Task</button>
                    </div>
                </div>
            </div>
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
                    <th scope="col" class="d-none d-md-table-cell">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col" class="d-none d-md-table-cell">Description</th>
                    <th scope="col" class="d-none d-md-table-cell">Deadline</th>
                    <th scope="col">Status</th>
                    <th scope="col" class="text-center"></th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($tasks as $task)
                        <tr>
                            <th scope="row" class="d-none d-md-table-cell">{{$task->id}}</th>
                            <td>{{$task->name}}</td>
                            <td class="d-none d-md-table-cell">{{$task->description}}</td>
                            <td class="d-none d-md-table-cell">{{$task->deadline}}</td>
                            <td>{{$task->taskStatus->name}}</td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modal-data-to" wire:click="dispatch('eventAction', ['edit', {{$task->id}}])">Update</a></li>
                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modal-delete" wire:click="dispatch('eventConfirm', [{{$task->id}}])">Delete</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
              </table>

              {{$tasks->links()}}
            @endif
        </div>
        <div class="card-footer">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <button wire:click="dispatch('eventAction', ['store'])" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-data-to">New Task</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <livewire:task.modal-data-to />
    <livewire:task.modal-delete />
</div>


