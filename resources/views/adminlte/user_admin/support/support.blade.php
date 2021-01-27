@extends('adminlte::page')

@section('title', 'Support')

@section('content_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page"><a>{{ __('Support') }}</a></li>
        </ol>
    </nav>
@stop

@section('content')
    <a class="btn btn-primary mb-3" href="/user/support/tickets/create" role="button">
        <i class="fas fa-eye mr-1"></i>
        {{ __('Create new ticket') }}
    </a>

    <div class="row">
        {{-- My Tickets --}}
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h1 class="card-title">{{ __('My Tickets') }}</h1>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    {{-- Filter table --}}
                    <table class="table table-striped table-bordered dt-responsive nowrap filter-table mb-3 col-lg-6 col-md-6 col-sm-12" style="display: none">
                        <tbody>
                        {{-- Column - ID --}}
                        <tr id="filter_col0" data-column="0">
                            <td>{{ __("Column - :name", ['name' => __("ID")]) }}</td>
                            <td align="center">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-search"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="column_filter form-control col-md-12" id="col0_filter">
                                    </div>
                                </div>
                            </td>
                        </tr>
                        {{-- Column - CATEGORY --}}
                        <tr id="filter_col1" data-column="1">
                            <td>{{ __("Column - :name", ['name' => __("CATEGORY")]) }}</td>
                            <td align="center">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-search"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="column_filter form-control col-md-12" id="col1_filter">
                                    </div>
                                </div>
                            </td>
                        </tr>
                        {{-- Column - TITLE --}}
                        <tr id="filter_col2" data-column="2">
                            <td>{{ __("Column - :name", ['name' => __("TITLE")]) }}</td>
                            <td align="center">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-search"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="column_filter form-control col-md-12" id="col2_filter">
                                    </div>
                                </div>
                            </td>
                        </tr>
                        {{-- Column - STATUS --}}
                        <tr id="filter_col3" data-column="3">
                            <td>{{ __('Column - :name', ['name' => __("STATUS")]) }}</td>
                            <td align="center">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-search"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="column_filter form-control" id="col3_filter">
                                    </div>
                                </div>
                            </td>
                        </tr>
                        {{-- Column - LAST UPDATED --}}
                        <tr id="filter_col4" data-column="4">
                            <td>{{ __('Column - :name', ['name' => __("LAST UPDATED")]) }}</td>
                            <td align="center">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-search"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="column_filter form-control" id="col4_filter">
                                    </div>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>

                    {{-- Data table --}}
                    <table class="table table-striped table-bordered dt-responsive nowrap TableStyle" id="tickets-table">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">{{ __('ID') }}</th>
                            <th scope="col">{{ __('CATEGORY') }}</th>
                            <th scope="col">{{ __('TITLE') }}</th>
                            <th scope="col">{{ __('STATUS') }}</th>
                            <th scope="col">{{ __('LAST UPDATED') }}</th>
                            <th scope="col">{{ __('ACTIONS') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($tickets as $ticket)
                            <tr>
                                <td>
                                    {{ $ticket->id }}
                                </td>

                                <td>
                                    {{ __($ticket->category->name) }}
                                </td>

                                <td>
                                    #{{ $ticket->ticket_id }} - {{ $ticket->title }}
                                </td>

                                <td class="TextMiddle">
                                    @if ($ticket->status === 'Opened')
                                        <span class="badge Opened mb-0">{{ __($ticket->status) }}</span>
                                    @elseif ($ticket->status === 'Closed')
                                        <span class="badge Closed mb-0">{{ __($ticket->status) }}</span>
                                    @endif
                                </td>

                                <td>{{ $ticket->updated_at->format('d.m.Y H:i') }}</td>

                                <td class="TextMiddle">
                                    <div class="container">
                                        <div class="row">
                                            <a class="btn btn-primary mr-1" href="{{ '/user/support/tickets/'. $hashids->encode($ticket->id) }}" role="button">
                                                <i class="fas fa-eye mr-1"></i>
                                                {{ __('View') }}
                                            </a>
                                        </div>
                                    </div>
                                </td>
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
    <link rel="stylesheet" href="{{ asset('css/adminlte.css') }}">
@stop

@section('js')
    <script>
        //// Tickets table ////

        // Filter function
        function filterColumn ( i ) {
            jQuery('#tickets-table').DataTable().column( i ).search(jQuery('#col'+i+'_filter').val()).draw();
        }

        // Table
        jQuery(document).ready(function() {
            const table = jQuery('#tickets-table').DataTable(
                {
                    // Specific columns
                    columnDefs: [
                        { "orderable": false, "targets": 5 },
                        { "width": "5%", "targets": [0] },
                        { "width": "10%", "targets": [1, 3, 4, 5] },
                    ],

                    // Order by asc/desc
                    order: [
                        [ 0, "asc" ]
                    ],

                    // Show entries length
                    lengthMenu: [
                        [10, 20, 30, -1],
                        [10, 20, 30, "All"]
                    ],

                    // Position of control elements
                    dom:
                        '<"col-lg-6 col-md-6 col-sm-12 mb-3 AdvanceFilter"Q>' +
                        '<"col-lg-6 col-md-6 col-sm-12 mb-3"B>' +
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
                        {
                            text: '<?php echo __('Advanced Filter')?>',
                            className: 'btn btn-info',

                            // Show/Hide toggle
                            action: function ( e, dt, node, config )
                            {
                                jQuery('.AdvanceFilter').fadeToggle();
                            }
                        }
                    ],

                    searchBuilder: {
                        columns: [0,1,2,3,4],
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
