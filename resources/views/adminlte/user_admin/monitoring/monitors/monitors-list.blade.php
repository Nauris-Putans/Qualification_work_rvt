@extends('adminlte::page')
@section('title', 'History')

@section('content_header')
    <h1>Monitoring > Monitors > History</h1>
@stop

@section('content')
<section class="monitorsList">

    <div class="row">
        {{-- Monitor list --}}
        <div class="col-12">
            <x-alertAdmin />
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h1 class="card-title">{{ __('Monitor list') }}</h1>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    {{-- Data table --}}
                    <table class="table table-striped table-bordered display  nowrap TableStyle" style="width: 100%" id="monitors-table">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">{{ __('Friendly name') }}</th>
                            <th scope="col">{{ __('URL/DNS/PING') }}</th>
                            <th scope="col">{{ __('Status') }}</th>
                            <th scope="col">{{ __('Something') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($sortedMonitors as $monitor)
                            <tr>
                                <td >{{ $monitor->friendly_name }}</td>
                                <td >{{ $monitor->check_address }}</td>
                                <td class="project-state">
                                    @if($monitor->status == 1)
                                        <span class="badge badge-success active" style="font-size: 18px">Active</span>
                                    @elseif($monitor->status == 2)
                                        <span class="badge" style="background-color: rgb(105, 105, 105); color: white; font-size: 18px">Paused</span>
                                    @endIf
                                </td>
                                <td >
                                    <div>
                                        <form method="POST" action="{{ URL::route('monitor.changeStatus', [$monitor->host_id]) }}">
                                            @csrf
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-folder">
                                                </i>
                                                {{ __('status')}}
                                            </button>
                                        </form>
                                        <form method="POST" action="{{ URL::route('monitor.destroy', [$monitor->host_id]) }}">
                                            @csrf
                                            <button type="submit" class="btn btn-danger" >
                                                <i class="fas fa-trash">
                                                </i>
                                                {{ __('Delete')}}
                                            </button>
                                        </form>
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
</section>
@stop

@section('css')

{{-- Table styles --}}
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/rowreorder/1.2.7/css/rowReorder.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.7/css/responsive.dataTables.min.css">
@stop

@section('js')
{{-- Data table js --}}
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready( function () {
        $('#monitors-table').DataTable( {
            // Allows you to scroll right and left if text is to long
            scrollX: true,
            scrollCollapse: true,

            // Show entries length
            lengthMenu: [
                [10, 20, 30, -1],
                [10, 20, 30, @json( __("All") )]
            ],

        });


    });


</script>
@stop
