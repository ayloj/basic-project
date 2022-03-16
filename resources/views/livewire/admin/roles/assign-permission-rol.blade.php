<form wire:submit.prevent="savePermissionToRole">
    <div class="card card-secondary">
        <div class="card-header ">
            <h3 class="card-title">Asignar Permiso a Rol <i class="fas fa-clipboard-check"></i></h3>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label>Rol:</label>
                <div class="input-group">
                    <select wire:click="onChengeRole($event.target.value)" class="form-control">
                        <option selected disabled>--ROLES--</option>
                        @forelse($roles as $rol)
                        <option value="{{ $rol->id }}">{{ $rol->name }}</option>
                        @empty
                        <option>Sin Roles registrados</option>
                        @endforelse
                    </select>
                </div>

            </div>
            {{-- --}}
            <div class="form-group">
                @forelse($permissions as $permission)
                <div class="custom-control custom-checkbox">
                    <input wire:model="permissionAtRole" value="{{ $permission->id }}"
                        id="customCheckbox{{ $permission->id }}" type="checkbox" class="custom-control-input">
                    <label for="customCheckbox{{ $permission->id }}" class="custom-control-label">{{
                        $permission->description }}</label>
                </div>
                @empty
                <span>Sin permisos asignados</span>
                @endforelse
                {{--<div>@json($permissionAtRole)</div>--}}
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
    </div>
</form>