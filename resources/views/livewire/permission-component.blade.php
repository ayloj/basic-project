<div class="row col-12">
    <div class="col-md-4">
        <div>
            @include("livewire.admin.roles.role-form")
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Lista de Roles</h3>
            </div>
            <div class="card-body">
                <table class="table table-sm table-striped">
                    <thead>
                        <tr>
                            <th>Rol</th>
                            <th>Descripción</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($roles as $rol)
                        <tr>
                            <td>{{ $rol->name }}</td>
                            <td>Descrip..</td>
                            <td>
                                <button class="btn btn-info btn-sm" wire:click="roleEditForm({{ $rol->id }})" title="Editar"><i class="fa-regular fa-pen-to-square"></i></button>
                                <button class="btn btn-danger btn-sm confirmDeleteRol" type="Rol" key-element="{{ $rol->id }}" title="Borrar"><i class="fa-solid fa-trash-can"></i></button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3"><span class="alert alert-warning">Sin Roles registrados</span></td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div>
            @include("livewire.admin.roles.permission-form")
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Lista de rutas de acceso</h3>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Permiso</th>
                            <th>Ruta</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($permissions as $permission)
                        <tr>
                            <td>{{ $permission->description }}</td>
                            <td>{{ $permission->name }}</td>
                            <td>
                                <button class="btn btn-info btn-sm" wire:click="permissionEditForm({{ $permission->id }})" title="Editar"><i class="fa-regular fa-pen-to-square"></i></button>
                                <button class="btn btn-danger btn-sm confirmDeletePermission" type="Permiso" key-element="{{ $permission->id }}" title="Borrar"><i class="fa-solid fa-trash-can"></i></button>
                            </td>
                        </tr>
                        @empty
                        <td cols=3 class="alert alert-warning">Sin permisos registrados</td>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div>
            @include("livewire.admin.roles.assign-permission-rol")
        </div>
    </div>


    <script>
        window.addEventListener('succesAlert', event => {
            console.log(event);
            Swal.fire(
                event.detail.message,
                '',
                'success'
            )
        });

        const listenerDeleteRol = document.querySelectorAll('.confirmDeleteRol, .confirmDeletePermission');

        listenerDeleteRol.forEach(btn => {
            btn.addEventListener('click', function(e) {
                deleteRol(e);
            });
        });

        function deleteRol(e) {
            let element = e.currentTarget.getAttribute("type");
            let elementId = e.currentTarget.getAttribute("key-element");
            let method = 'deleteRole';

            if(element == 'Permiso'){
                method = 'deletePermission';
            }

            Swal.fire({
                title: 'Eliminar '+element+'?',
                text: "Esta acción no se podra revertir!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar '+element+''
            }).then((result) => {
                if (result.value) {
                    switch (element) {
                            case "Rol":
                                @this.deleteRole(elementId);
                                break;
                            case "Permiso":
                                @this.deletePermission(elementId);
                                break;
                            default:
                                break;
                        }
                }
            });
        }
    </script>

</div>