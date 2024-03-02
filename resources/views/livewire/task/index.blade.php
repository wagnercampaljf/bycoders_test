<div>
    <div class="card offset-3 col-6 mb-4 mt-4">
        <h5 class="card-header">Search Tasks</h5>
        <div class="card-body">
            <form>
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="inputNameFilter" class="form-label">Name</label>
                                <input type="text" class="form-control" id="inputNameFilter">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="inputInitialDateFilter" class="form-label">Initial Date</label>
                                <input type="date" class="form-control" id="inputInitialDateFilter" >
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                            <label for="inputFinalDateFilter" class="form-label">Final Date</label>
                                <input type="date" class="form-control" id="inputFinalDateFilter" >
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
   
    <div class="card offset-2 col-8">
        <div class="card-header">
            <h5 >Task List</h5>
        </div>
        <div class="card-body">
            @if ($tasks->isEmpty())
                <div class="alert alert-secundary text-center mb-0" role="alert">
                    No tasks registered.
                </div>
            @else
            <table class="table table-striped table-hover">
                <thead>
                  <tr class="table-secundary">
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Deadline</th>
                    <th scope="col">Status</th>
                    <th scope="col" class="text-center">Options</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($tasks as $task)
                        <tr>
                            <th scope="row">{{$task->id}}</th>
                            <td>{{$task->name}}</td>
                            <td>{{$task->description}}</td>
                            <td>{{$task->deadline}}</td>
                            <td>{{$task->taskStatus->name}}</td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#"data-toggle="modal" data-target="#modal-data-to" wire:click="$emit('eventAction', 'edit', {{--$account->id --}})">Editar</a></li>
                                    <li><a class="dropdown-item" href="#"data-toggle="modal" data-target="#modal-delete" wire:click="$emit('evenConfirm', {{-- $account->id --}})">Excluir</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
              </table>
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
</div>


