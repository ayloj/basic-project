@extends('adminlte::page')

@section('title', 'Index')

@section('content_header')
<h1>Edición de Permiso</h1>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <form action="{{ route('admin.update_permission', $permission) }}" method="post">
            @csrf
            @method('PATCH')
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Edición de permiso / ruta</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Nombre de ruta de acceso:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="route_name" value="{{ $permission->name }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Descripción:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="description" value="{{ $permission->description }}">
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </div>
            </div>
        </form>
    </div>
</div>
@stop