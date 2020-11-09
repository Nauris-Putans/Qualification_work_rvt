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
@stop

@section('content')
    <div class="row">
        <div class="col-md-3">
            <x-alertAdmin />
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h1 class="card-title">@lang('Add Role')</h1>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    {{ Form::component('addRoleForm', 'components.form.adminlte.admin.add-role-form', ['name', 'value' => null, 'attributes' => []]) }}
                    {{ Form::addRoleForm() }}
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h1 class="card-title">@lang('Assign Permissions to Role')</h1>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="checkall" class="permissions">
                                </div>
                            </th>
                            <th scope="col">ID</th>
                            <th scope="col">NAME</th>
                            <th scope="col">DISPLAY NAME</th>
                            <th scope="col">DESCRIPTION</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($permissions as $permission)
                            <tr>
                                <th scope="row">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" name="permissions[]" class="permissions" value={{ $permission->id }}>
                                    </div>
                                </th>
                                <td>{{ $permission->id }}</td>
                                <td>{{ $permission->name }}</td>
                                <td>{{ $permission->display_name }}</td>
                                <td>{{ $permission->description }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')

@stop

@section('js')
    {{-- Check all checkbox script--}}
    <script>
        jQuery("#checkall").click(function (){
            if (jQuery("#checkall").is(':checked')){
                jQuery(".permissions").each(function (){
                    jQuery(this).prop("checked", true);
                });
            }else{
                jQuery(".permissions").each(function (){
                    jQuery(this).prop("checked", false);
                });
            }
        });
    </script>
@stop
