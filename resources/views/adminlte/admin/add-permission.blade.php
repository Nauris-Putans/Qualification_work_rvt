@extends('adminlte::page')
@section('title', 'Add Permission')

@section('content_header')
    <h1>Team Members > Privileges > Permissions > Add Permission</h1>
@stop

@section('content')
    {{ Form::component('addPermissionForm', 'components.form.adminlte.admin.add-permission-form', ['name', 'value' => null, 'attributes' => []]) }}
    {{ Form::addPermissionForm() }}
@stop

@section('css')

@stop

@section('js')

@stop
