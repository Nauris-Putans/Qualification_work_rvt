@extends('adminlte::page')
@section('title', 'Assign Role')

@section('content_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a>@lang('Team')</a></li>
            <li class="breadcrumb-item"><a>@lang('Privileges')</a></li>
            <li class="breadcrumb-item"><a>@lang('Roles')</a></li>
            <li class="breadcrumb-item active" aria-current="page">@lang('Assign Role')</li>
        </ol>
    </nav>

    <br>
    <h1>@lang('Assign Role')</h1>
@stop

@section('content')
    {{ Form::component('assignRoleForm', 'components.form.adminlte.admin.assign-role-form', ['roles' => $roles, 'users' => $users]) }}
    {{ Form::assignRoleForm() }}
@stop

@section('css')

@stop

@section('js')

@stop
