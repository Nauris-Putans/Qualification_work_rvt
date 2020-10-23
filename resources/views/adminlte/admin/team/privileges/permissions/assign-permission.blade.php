@extends('adminlte::page')
@section('title', 'Assign Permission')

@section('content_header')
    <h1>Team > Privileges > Permissions > Assign Permission</h1>
@stop

@section('content')
    {{ Form::component('assignPermissionForm', 'components.form.adminlte.admin.assign-permission-form', ['permissions' => $permissions, 'users' => $users]) }}
    {{ Form::assignPermissionForm() }}
@stop

@section('css')

@stop

@section('js')

@stop
