@extends('adminlte::page')
@section('title', 'Add Role')

@section('content_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a>@lang('Team')</a></li>
            <li class="breadcrumb-item"><a>@lang('Privileges')</a></li>
            <li class="breadcrumb-item"><a>@lang('Roles')</a></li>
            <li class="breadcrumb-item active" aria-current="page">@lang('Add Role')</li>
        </ol>
    </nav>

    <br>
    <h1>@lang('Add Role')</h1>
@stop

@section('content')
    {{ Form::component('addRoleForm', 'components.form.adminlte.admin.add-role-form', ['name', 'value' => null, 'attributes' => []]) }}
    {{ Form::addRoleForm() }}
@stop

@section('css')

@stop

@section('js')

@stop
