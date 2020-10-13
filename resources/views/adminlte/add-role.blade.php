@extends('adminlte::page')
@section('title', 'Add Role')

@section('content_header')
    <h1>Add Role</h1>
@stop

@section('content')
    {{ Form::component('addRoleForm', 'components.form.adminlte.add-role-form', ['name', 'value' => null, 'attributes' => []]) }}
    {{ Form::addRoleForm() }}
@stop

@section('css')

@stop

@section('js')

@stop
