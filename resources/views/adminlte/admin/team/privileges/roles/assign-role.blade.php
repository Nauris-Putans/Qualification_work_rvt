@extends('adminlte::page')
@section('title', 'Assign Role')

@section('content_header')
    <h1>Team > Privileges > Roles > Assign Role</h1>
@stop

@section('content')
    {{ Form::component('assignRoleForm', 'components.form.adminlte.admin.assign-role-form', ['roles' => $roles, 'users' => $users]) }}
    {{ Form::assignRoleForm() }}
@stop

@section('css')

@stop

@section('js')

@stop
