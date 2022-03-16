<form wire:submit.prevent="permissionUpdate">
<div class="card card-info">
    <div class="card-header ">
        <h3 class="card-title">Edición de permiso / ruta <i class="fas fa-clipboard-check"></i></h3>
    </div>
    <div class="card-body">
        <div class="form-group">
            <label>Nombre de ruta de acceso:</label>
            <div class="input-group">
                <input type="text" class="form-control" wire:model="route_name">
                @error('route_name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-group">
            <label>Descripción:</label>
            <div class="input-group">
                <input type="text" class="form-control" wire:model="description">
                @error('description') <span class="alert alert-danger">{{ $message }}</span> @enderror
            </div>
        </div>
    </div>
    <div class="card-footer">
        <button class="btn btn-primary">Editar</button>
    </div>
</div>
</form>