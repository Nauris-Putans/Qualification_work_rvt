@extends('adminlte::page')
@section('title', 'Assign Role')

@section('content_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a>{{ __('Team') }}</a></li>
            <li class="breadcrumb-item"><a>{{ __('Privileges') }}</a></li>
            <li class="breadcrumb-item"><a>{{ __('Roles') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('Assign Role') }}</li>
        </ol>
    </nav>
@stop

@section('content')
    {{ Form::component('assignRoleForm', 'components.form.adminlte.admin.assign-role-form', ['roles' => $roles, 'users' => $users]) }}
    {{ Form::assignRoleForm() }}
@stop

@section('css')

@stop

@section('js')

@stop
