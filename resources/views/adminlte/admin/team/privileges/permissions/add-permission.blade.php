@extends('adminlte::page')
@section('title', 'Add Permission')

@section('content_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a>@lang('Team')</a></li>
            <li class="breadcrumb-item"><a>@lang('Privileges')</a></li>
            <li class="breadcrumb-item"><a>@lang('Permissions')</a></li>
            <li class="breadcrumb-item active" aria-current="page">@lang('Add Permission')</li>
        </ol>
    </nav>

    <br>
    <h1>@lang('Add Permission')</h1>
@stop

@section('content')
    {{ Form::component('addPermissionForm', 'components.form.adminlte.admin.add-permission-form', ['name', 'value' => null, 'attributes' => []]) }}
    {{ Form::addPermissionForm() }}
@stop

@section('css')

@stop

@section('js')

@stop
