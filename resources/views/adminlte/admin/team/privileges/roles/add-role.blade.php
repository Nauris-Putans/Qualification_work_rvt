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
    <form method="post" action="/admin/add-role">
        @csrf

        <div class="row">
            {{-- Add Role box--}}
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

            {{-- Assign Permissions to Role box--}}
            <div class="col-md-9">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h1 class="card-title">@lang('Assign Permissions to Role')</h1>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        {{-- Filter table --}}
                        <table class="table table-striped table-bordered dt-responsive nowrap filter-table mb-3" style="width:50%; display: none">
                            <thead>
                                <tr>
                                    <th>Target</th>
                                    <th>Search text</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr id="filter_col1" data-column="1">
                                    <td>Column - ID</td>
                                    <td align="center"><input type="text" class="column_filter form-control form-control-sm" id="col1_filter"></td>
                                </tr>
                                <tr id="filter_col2" data-column="2">
                                    <td>Column - NAME</td>
                                    <td align="center"><input type="text" class="column_filter form-control form-control-sm" id="col2_filter"></td>
                                </tr>
                                <tr id="filter_col3" data-column="3">
                                    <td>Column - DISPLAY NAME</td>
                                    <td align="center"><input type="text" class="column_filter form-control form-control-sm" id="col3_filter"></td>
                                </tr>
                                <tr id="filter_col4" data-column="4">
                                    <td>Column - DESCRIPTION</td>
                                    <td align="center"><input type="text" class="column_filter form-control form-control-sm" id="col4_filter"></td>
                                </tr>
                            </tbody>
                        </table>

                        {{-- Data table --}}
                        <table class="table table-striped table-bordered dt-responsive nowrap" id="permissions-table" style="width:100%">
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
                                                <input type="checkbox" name="permissions[]" class="permissions" value={{ $permission->id }} >
                                            </div>
                                        </th>
                                        <td class="Text">{{ $permission->id }}</td>
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
    </form>
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('css/adminlte.css') }}">
@stop

@section('js')
    <script>
        // Check all checkboxes script
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

        //// Permissions table ////

        // Filter function
        function filterColumn ( i ) {
            jQuery('#permissions-table').DataTable().column( i ).search(
                jQuery('#col'+i+'_filter').val(),
            ).draw();
        }

        // Table
        jQuery(document).ready(function() {
            jQuery('#permissions-table').DataTable( {
                // Specific columns
                "columnDefs": [
                    { "orderable": false, "targets": 0 },
                    { "width": "8%", "targets": 0 },
                ],

                // Order by asc/desc
                "order": [[ 1, "asc" ]],

                // Show entries length
                "lengthMenu": [[10, 20, 30, -1], [10, 20, 30, "All"]],

                // Position of control elements
                "dom": '<"row"' +
                    '<"col-sm-12 col-md-6"l>' +
                    '<"col-sm-12 col-md-5"f>' +
                    '<"col-sm-12 col-md-1"B>' +
                    '>' +
                    't' +
                    '<"row"' +
                    '<"col-sm-6 col-md-6"i>' +
                    '<"col-sm-6 col-md-6"p>' +
                    '>',

                // Button - controler element
                buttons: [
                    {
                        text: 'Filter',

                        // Show/Hide toggle
                        action: function ( e, dt, node, config ) {
                            jQuery('.filter-table').toggle();
                        }
                    }
                ]
            } );

            // Filter script
            jQuery('input.column_filter').on( 'keyup click', function () {
                filterColumn( jQuery(this).parents('tr').attr('data-column') );
            } );
        } );
    </script>
@stop
