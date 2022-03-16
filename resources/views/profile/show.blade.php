@extends('adminlte::page')

@section('title', 'Index')

@section('content_header')
    <h1>Perfil</h1>
@stop

@section('content')
<div>
       {{-- @if (Laravel\Fortify\Features::canUpdateProfileInformation())--}}
            @livewire('profile.update-profile-information-form')

            <x-jet-section-border />
       {{-- @endif--}}

       {{-- @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))--}}
            @livewire('profile.update-password-form')

            <x-jet-section-border />
        {{--@endif--}}

        {{--@if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())--}}
            @livewire('profile.two-factor-authentication-form')

            <x-jet-section-border />
        {{--@endif--}}

        {{--@livewire('profile.logout-other-browser-sessions-form')

        {{--@if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())--}}
            <x-jet-section-border />

            @livewire('profile.delete-user-form')
        {{--@endif--}}
    </div>
@stop

@section('js')
    @stack('modals')
@stop


