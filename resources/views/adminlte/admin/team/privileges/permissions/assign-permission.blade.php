@extends('adminlte::page')
@section('title', 'Assign Permission')

@section('content_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a>@lang('Team')</a></li>
            <li class="breadcrumb-item"><a>@lang('Privileges')</a></li>
            <li class="breadcrumb-item"><a>@lang('Permissions')</a></li>
            <li class="breadcrumb-item active" aria-current="page">@lang('Assign Permission')</li>
        </ol>
    </nav>

    <br>
    <h1>@lang('Assign Permission')</h1>
@stop

@section('content')
    {{ Form::component('assignPermissionForm', 'components.form.adminlte.admin.assign-permission-form', ['permissions' => $permissions, 'users' => $users]) }}
    {{ Form::assignPermissionForm() }}
@stop

@section('css')

@stop

@section('js')

@stop
