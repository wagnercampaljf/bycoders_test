<div>
    <div wire:ignore.self class="modal fade" id="modal-delete" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">    
                    Do you want to delete permanently?
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-block" wire:click="delete">
                    <i class="fas fa-check"></i>
                    Confirm
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