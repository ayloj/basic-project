<form wire:submit.prevent="{{$formActionRole}}">
    <div class="card card-{{$formColorRole}}">
        <div class="card-header ">
            <h3 class="card-title">{{$formBtnRole}} Rol <i class="fas fa-address-card"></i></h3>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label>Nombre del Rol:</label>
                <div class="input-group">
                    <input type="text" class="form-control" wire:model="rol_name">
                    @error('rol_name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">{{$formBtnRole}}</button>
        </div>
    </div>
</form>