@extends('adminlte::page')

@section('title', 'Index')

@section('content_header')
<h1>Administracion de Roles y Permisos</h1>
@stop

@section('content')
<div class="row">
    @livewire('permission-component')
</div>
@stop

