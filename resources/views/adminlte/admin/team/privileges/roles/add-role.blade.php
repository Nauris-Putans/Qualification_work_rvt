@extends('adminlte::page')
@section('title', 'Add Role')

@section('content_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a>{{ __('Team') }}</a></li>
            <li class="breadcrumb-item"><a>{{ __('Privileges') }}</a></li>
            <li class="breadcrumb-item"><a>{{ __('Roles') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('Add Role') }}</li>
        </ol>
    </nav>
@stop

@section('content')
    <form method="post" action="/admin/roles">
        @csrf

        <div class="row">
            {{-- Add Role box--}}
            <div class="col-md-3">
                <x-alertAdmin />
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h1 class="card-title">{{ __('Add Role') }}</h1>
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
                        <h1 class="card-title">{{ __('Assign Permissions to Role') }}</h1>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        {{-- Data table --}}
                        <table class="table table-striped table-bordered nowrap TableStyle" id="permissions-table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" id="checkall" class="permissions">
                                        </div>
                                    </th>
                                    <th scope="col">{{ __('ID') }}</th>
                                    <th scope="col">{{ __('NAME') }}</th>
                                    <th scope="col">{{ __('DISPLAY NAME') }}</th>
                                    <th scope="col">{{ __('DESCRIPTION') }}</th>
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
                                        <td>{{ __($permission->display_name) }}</td>
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
        jQuery("#checkall").click(function () {
            if (jQuery("#checkall").is(':checked'))
            {
                jQuery(".permissions").each(function ()
                {
                    jQuery(this).prop("checked", true);
                });
            }

            else
            {
                jQuery(".permissions").each(function ()
                {
                    jQuery(this).prop("checked", false);
                });
            }
        });

        //// Permissions table ////

        // Filter function
        function filterColumn ( i ) {
            jQuery('#permissions-table').DataTable().column( i ).search(jQuery('#col'+i+'_filter').val()).draw();
        }

        // Table
        jQuery(document).ready(function() {
            const table = jQuery('#permissions-table').DataTable(
            {
                // Specific columns
                columnDefs: [
                    { "orderable": false, "targets": 0 },
                    { "width": "8%", "targets": 0 },
                    { "width": "7%", "targets": 1 },
                ],

                // Allows you to scroll right and left if text is to long
                scrollX: true,
                scrollCollapse: true,

                // Order by asc/desc
                order: [
                    [ 1, "asc" ]
                ],

                // Show entries length
                lengthMenu: [
                    [10, 20, 30, 40, 50],
                    [10, 20, 30, 40, 50]
                ],

                // Position of control elements
                dom:
                    '<"row"' +
                    '<"col-lg-6 col-md-6 col-sm-12"l>' +
                    '<"col-lg-6 col-md-6 col-sm-12"f>' +
                    '>' +
                    't' +
                    '<"row"' +
                    '<"col-sm-12 col-md-6"i>' +
                    '<"col-sm-12 col-md-6"p>' +
                    '>'
                ,

                // Button - controler element
                buttons: [
                    {
                        text: '<?php echo __('Filter')?>',
                        className: 'btn btn-primary',

                        // Show/Hide toggle
                        action: function ( e, dt, node, config )
                        {
                            jQuery('.filter-table').fadeToggle();
                        }
                    },
                ],

                searchBuilder: {
                    columns: [1,2,3,4],
                    conditions: {
                        "date":{
                            '!=': {
                                conditionName: "<?php echo __('Not')?>",
                            },
                            '!between': {
                                conditionName: "<?php echo __('Not Between')?>",
                            },
                            '!null': {
                                conditionName: "<?php echo __('Not Empty')?>",
                            },
                            '<': {
                                conditionName: "<?php echo __('Before')?>",
                            },
                            '=': {
                                conditionName: "<?php echo __('Equals')?>",
                            },
                            '>': {
                                conditionName: "<?php echo __('After')?>",
                            },
                            'between': {
                                conditionName: "<?php echo __('Between')?>",
                            },
                            'null': {
                                conditionName: "<?php echo __('Empty')?>",
                            },
                        },
                        "num":{
                            '!=': {
                                conditionName: "<?php echo __('Not')?>",
                            },
                            '!between': {
                                conditionName: "<?php echo __('Not Between')?>",
                            },
                            '!null': {
                                conditionName: "<?php echo __('Not Empty')?>",
                            },
                            '<': {
                                conditionName: "<?php echo __('Less Than')?>",
                            },
                            '<=': {
                                conditionName: "<?php echo __('Less Than Equal To')?>",
                            },
                            '=': {
                                conditionName: "<?php echo __('Equals')?>",
                            },
                            '>': {
                                conditionName: "<?php echo __('Greater Than')?>",
                            },
                            '>=': {
                                conditionName: "<?php echo __('Greater Than Equal To')?>",
                            },
                            'multipleOf': {
                                conditionName: "<?php echo __('Value + ')?>", // String value that will be displayed in the condition select element
                                init: function (that, fn, preDefined = null) {
                                    // Declare the input element and set the listener to trigger searching
                                    const el =  jQuery('<input/>').on('input', function() { fn(that, this) });

                                    // Add mechanism to apply preDefined values that may be passed in
                                    if (preDefined !== null) {
                                        jQuery(el).val(preDefined[0]);
                                    }

                                    return el;
                                },
                                inputValue: function (el) {
                                    // Return the value within the input element
                                    return jQuery(el[0]).val();
                                },
                                isInputValid: function (el, that) {
                                    // If there is text in the input element then it is valid for searching
                                    return jQuery(el[0]).val().length !== 0;
                                },
                                search: function (value, comparison) {
                                    // Use the modulo (%) operator to check that there is no remainder
                                    return value%comparison === 0;
                                }
                            },
                            'between': {
                                conditionName: "<?php echo __('Between')?>",
                            },
                            'null': {
                                conditionName: "<?php echo __('Empty')?>",
                            },
                        },
                        "string":{
                            '!=': {
                                conditionName: "<?php echo __('Not')?>",
                            },
                            '!null': {
                                conditionName: "<?php echo __('Not Empty')?>",
                            },
                            '=': {
                                conditionName: "<?php echo __('Equals')?>",
                            },
                            'contains': {
                                conditionName: "<?php echo __('Contains')?>",
                            },
                            'ends': {
                                conditionName: "<?php echo __('Ends With')?>",
                            },
                            'null': {
                                conditionName: "<?php echo __('Empty')?>",
                            },
                            'starts': {
                                conditionName: "<?php echo __('Starts With')?>",
                            },
                        },
                    },
                },

                // Language
                language: {
                    searchBuilder: {
                        add: "<?php echo __('Add Condition')?>",
                        condition: "<?php echo __('Condition')?>",
                        clearAll: "<?php echo __('Clear All')?>",
                        deleteTitle: "<?php echo __('Delete')?>",
                        data: "<?php echo __('Column')?>",
                        leftTitle: "<?php echo __('Left')?>",
                        logicAnd: "<?php echo __('AND')?>",
                        logicOr: "<?php echo __('OR')?>",
                        rightTitle: "<?php echo __('Right')?>",
                        title: {
                            0: "<?php echo __('Advanced Filter')?>",
                            _: "<?php echo __('Advanced Filter (%d)')?>",
                        },
                        value: "<?php echo __('Value')?>",
                    },
                    "decimal":              "",
                    "emptyTable":           "<?php echo __('No data available in table')?>",
                    "info":                 "<?php echo __('Showing')?> _START_ <?php echo __('to')?> _END_ <?php echo __('of')?> _TOTAL_ <?php echo __('entries')?>",
                    "infoEmpty":            "<?php echo __('Showing 0 to 0 of 0 entries')?>",
                    "infoFiltered":         "(<?php echo __('filtered from')?> _MAX_ <?php echo __('total entries')?>)",
                    "infoPostFix":          "",
                    "thousands":            ",",
                    "lengthMenu":           "<?php echo __('Display')?> _MENU_ <?php echo __('records per page')?>",
                    "loadingRecords":       "<?php echo __('Loading...')?>",
                    "processing":           "<?php echo __('Processing...')?>",
                    "search":               "<?php echo __('Search:')?>",
                    "zeroRecords":          "<?php echo __('No matching records found')?>",
                    "paginate":
                    {
                        "first":            "<?php echo __('First')?>",
                        "last":             "<?php echo __('Last')?>",
                        "next":             "<?php echo __('Next')?>",
                        "previous":         "<?php echo __('Previous')?>"
                    },
                    "aria":
                    {
                        "sortAscending":    "<?php echo __(': activate to sort column ascending')?>",
                        "sortDescending":   "<?php echo __(': activate to sort column descending')?>"
                    }
                },

                // Removes btn-secondary from button
                initComplete: function() {
                    const btns = jQuery('.btn-primary');
                    btns.removeClass('btn-secondary');
                },
            });
        });

        // Filter script
        jQuery('input.column_filter').on( 'keyup click', function () {
            filterColumn( jQuery(this).parents('tr').attr('data-column') );
        });
    </script>
@stop
