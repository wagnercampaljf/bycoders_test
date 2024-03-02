<div class="card offset-3 col-6">
  <h5 class="card-header">Create custumer</h5>
  <div class="card-body">
    <form wire:submit="save()">
        <div class="mb-3">
            <label for="inputName" class="form-label">Name</label>
            <input wire:model="name" type="text" class="form-control" id="inputNAme" aria-describedby="nameHelp">
            <div id="nameHelp" class="form-text text-danger">
                @error('name')
                    {{ $message }}
                @enderror
            </div>
        </div>
        <div class="mb-3">
            <label for="inputEmail" class="form-label">Email</label>
            <input wire:model="email" type="email" class="form-control" id="inputEmail" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text text-danger">
                @error('email')
                    {{ $message }}
                @enderror
            </div>
        </div>
        <div class="mb-3">
            <label for="inputPhone" class="form-label">Phone</label>
            <input wire:model="phone" type="text" class="form-control" id="inputPhone">
            <div id="inputPhone" class="form-text text-danger">
                @error('phone')
                    {{ $message }}
                @enderror
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
</div>