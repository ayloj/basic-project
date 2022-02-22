@extends('adminlte::page')

@section('title', 'Index')

@section('content_header')
<h1>Administracionde Roles y Permisos</h1>
@stop

@section('content')
<div class="row">
    @if (session('status'))
    <div class="col-md-12 alert alert-{{session('status')}}">
        <p>{{session('message')}}</p>
    </div>
    @endif
    <div class="col-md-4">
        <form action="{{ route('admin.store_role') }}" method="post">
            @csrf
            <div class="card card-secondary">
                <div class="card-header ">
                    <h3 class="card-title">Crear Rol <i class="fas fa-address-card"></i></h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Nombre del Rol:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="rol_name">
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Crear</button>
                </div>
            </div>
        </form>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Lista de Roles</h3>
            </div>
            <div class="card-body">
                @forelse($roles as $rol)
                <ul>
                    <li>{{ $rol->name }}</li>
                </ul>
                @empty
                <p class="alert alert-warning">Sin Roles registrados</p>
                @endforelse
            </div>
        </div>
    </div>


    <div class="col-md-4">
        <form action="{{ route('admin.store_permission') }}" method="post">
            @csrf
            <div class="card card-secondary">
                <div class="card-header ">
                    <h3 class="card-title">Crea Permiso <i class="fas fa-clipboard-check"></i></h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Nombre de ruta de acceso:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="route_name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Descripción:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="description">
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Crear</button>
                </div>
            </div>
        </form>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Lista de rutas de acceso</h3>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Task</th>
                            <th>Progress</th>
                            <th style="width: 40px">Label</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($permissions as $permission)
                        <tr>
                            <td>{{ $permission->description }}</td>
                            <td>{{ $permission->name }}</td>
                            <td>
                                <form action="{{ route('admin.edit_permission', $permission) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <button class="btn btn-sm btn-app" type="submit"><i class="fas fa-edit"></i> Edit</button>
                                </form>
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
        <form action="{{ route('admin.store_permission') }}" method="post">
            @csrf
            <div class="card card-secondary">
                <div class="card-header ">
                    <h3 class="card-title">Asignar permiso a Rol <i class="fas fa-clipboard-check"></i></h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Nombre de ruta de acceso:</label>
                        <div class="input-group">
                            <select name="role" class="form-control">
                                @forelse($roles as $rol)
                                <option value="{ $rol->id }}">{{ $rol->name }}</option>
                                @empty
                                <option>Sin Roles registrados</option>
                                @endforelse
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Descripción:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="description">
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Crear</button>
                </div>
            </div>
        </form>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Permisos de Rol</h3>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Task</th>
                            <th>Progress</th>
                            <th style="width: 40px">Label</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($permissions as $permission)
                        <tr>
                            <td>{{ $permission->description }}</td>
                            <td>{{ $permission->name }}</td>
                            <td>
                                <form action="{{ route('admin.edit_permission', $permission) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <button class="btn btn-sm btn-app" type="submit"><i class="fas fa-edit"></i> Edit</button>
                                </form>
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

</div>
@stop