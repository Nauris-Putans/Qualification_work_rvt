@extends('adminlte::page')
@section('title', 'Add Role')

@section('content_header')
    <h1>Team Members > Privileges > Roles > Add Role</h1>
@stop

@section('content')
    {{ Form::component('addRoleForm', 'components.form.adminlte.admin.add-role-form', ['name', 'value' => null, 'attributes' => []]) }}
    {{ Form::addRoleForm() }}
@stop

@section('css')

@stop

@section('js')

@stop
