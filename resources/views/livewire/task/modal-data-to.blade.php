<div>
    <div wire:ignore.self class="modal fade" id="modal-data-to" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">    
                    @if ($action === 'store')
                        New Task
                    @else
                        Update Task
                    @endif
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="inputName" class="form-label">Name</label>
                    <input wire:model="name" type="text" class="form-control" id="inputName" aria-describedby="nameError">
                    @error('name') <div id="nameError" class="form-text text-danger">{{$message}}</div> @enderror
                        
                    
                </div>
                <div class="mb-3">
                    <div class="form-floating">
                        <textarea wire:model="description" class="form-control" placeholder="Description blablab" id="floatingTextareaDescription" style="height: 100px"></textarea>
                        <label for="floatingTextareaDescription">Description</label>
                        @error('description') <div id="nameError" class="form-text text-danger">{{$message}}</div> @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label for="inputDeadLine" class="form-label">Deadline</label>
                    <input wire:model="deadline" type="datetime-local" class="form-control" id="inputDeadLine" aria-describedby="inputDeadLineError">
                    @error('deadline') <div id="nameError" class="form-text text-danger">{{$message}}</div> @enderror
                </div>
                <div class="mb-3">
                    <label for="selectStatus" class="form-label">Status</label>
                    <select wire:model="taskStatusId" id="selectStatus" class="form-select" aria-label="Default select example">
                            <option value=></option>
                            <option value=1>Pending</option>
                            <option value=2>Completed</option>
                            <option value=3>Overdue</option>
                    </select>
                    @error('taskStatusId') <div id="nameError" class="form-text text-danger">{{$message}}</div> @enderror
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-block" wire:click="submit">
                    <i class="fas fa-cloud-upload-alt"></i>
                    SALVAR
                </button>

            </div>
            </div>
        </div>
    </div>
</div>


<script>

    document.addEventListener('livewire:init', () => {
        Livewire.on('modalClose', (modalId) => {
            $(modalId).modal('hide')
        })
    })

</script>