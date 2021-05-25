@extends('adminlte::page')
@section('title', __('History'))

@section('content_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
                <a href="{{ URL::route('admin.user_admin.index') }}" >{{ __('Dashboard')}}</a>
                \
                <a >{{ __('Monitor list')}}</a>
            </li>
        </ol>
    </nav>
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
                    <table class="table table-striped table-bordered nowrap TableStyle" style="width: 100%" id="monitors-table">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">{{ __('MONITOR') }}</th>
                            <th scope="col">{{ __('PERSONS') }}</th>
                            <th scope="col">{{ __('CHECK INTERVAL') }}</th>
                            <th scope="col">{{ __('CREATED') }}</th>
                            <th scope="col">{{ __('STATUS') }}</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($sortedMonitors as $monitor)
                            <tr>
                                <td >#</td>
                                <td >
                                    <div class="monitor-info-Wrapper">
                                        <div class="friendlyName">{{ $monitor->friendly_name }}</div>
                                        <div class="checkAddress">{{ $monitor->check_address }}</div>
                                    </div>
                                </td>
                                <td>
                                    <ul class="list-inline">
                                        @if($monitor->users != null)
                                            @foreach($monitor->users as $user)
                                            <li class="list-inline-item" id="user{{ $monitor->host_id.$user->id}}">
                                                <a href="{{ URL::route('userProfile.show', [$user->id]) }}">
                                                    @if($user->profile_image)
                                                        <img alt="Avatar" class="table-avatar" src="../../../..{{ $user->profile_image}}">
                                                    @else
                                                        @if($user->gender == 'Female')
                                                            <img alt="Avatar" class="table-avatar" src="../../../../images/256x256/256_12.png">
                                                        @else
                                                            <img alt="Avatar" class="table-avatar" src="../../../../images/256x256/256_13.png">
                                                        @endif
                                                    @endif

                                                    <div class="content" id="content{{ $monitor->host_id.$user->id}}">
                                                        <div class="arrow"></div>
                                                        <div class="personName">{{ $user->fullName }}</div>
                                                        <div class="personEmail">{{ $user->email }}</div>
                                                    </div>
                                                </a>
                                            </li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </td>
                                <td >{{ $monitor->checkInterval }}</td>
                                <td>
                                    <div class="monitor-info-Wrapper">
                                        @if($monitor->created_at != null)
                                            <div class="friendlyName">{{ $monitor->created_at->date }}</div>
                                            <div class="checkAddress">{{ $monitor->created_at->time }}</div>
                                        @endif
                                    </div>
                                </td>
                                <td> 
                                    <form method="POST" action="{{ URL::route('monitor.changeStatus', [$monitor->host_id]) }}">
                                        @csrf
                                        <button class="status-box">
                                            @if($monitor->status == 1)
                                                <div class="status-icon status-icon-active" ></div>
                                                <div class="status-text">Active</div>
                                            @elseif($monitor->status == 2)
                                                <div class="status-icon status-icon-disabled" ></div>
                                                <div class="status-text">Disabled</div>
                                            @else
                                                <div class="status-icon status-icon-noAlert" ></div>
                                                <div class="status-text">No alert</div>
                                            @endIf
                                        </button> 
                                    </form>
                                </td>
                                <td >
                                    <div class="d-flex">
                                        <button type="submit" class="btn btn-info btn-sm" >
                                            <i class="fas fa-history"></i>
                                            {{ __('Hystory')}}
                                        </button>
                                        <form method="GET" action="{{ URL::route('monitor.edit', [$monitor->host_id]) }}">
                                            @csrf
                                            <button class="btn btn-primary btn-sm m-left-5" href="#">
                                                <i class="far fa-edit"></i>
                                                {{ __('Edit')}}
                                            </button>
                                        </form>
                                        <form method="POST" action="{{ URL::route('monitor.destroy', [$monitor->host_id]) }}">
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm m-left-5" >
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

<link href="/css/adminlte/user_admin/monitorList.css" rel="stylesheet">
{{-- Table styles --}}
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css">
@stop

@section('js')
{{-- Data table js --}}
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready( function () {

        // Get a reference to the element that you want to work with
        const userImg = document.querySelectorAll("li.list-inline-item");

        for (let i = 0; i < userImg.length; ++i) {
            userImg[i].addEventListener("mouseover", function() {
                const contentId = 'content'+userImg[i].id.replace('user','');
                $('#'+contentId).css("display", "block");
            });

            userImg[i].addEventListener("mouseleave", function() {
                const contentId = 'content'+userImg[i].id.replace('user','');
                $('#'+contentId).css("display", "none");
            });
        }

        $('#monitors-table').DataTable( {

            "order": [[1,"asc"]], 
            // Specific columns
            columnDefs: [
                { "orderable": false, "targets": [0,2,3,4,5,6] },
                { "width": '2%', "targets": 0 },
                { "width": '40%', "targets": 1 },
                { "width": '14%', "targets": 2 },
                { "width": '2%', "targets": 3 },
                { "width": '14%', "targets": 4 },
                { "width": '14%', "targets": 5 },
                { "width": '14%', "targets": 6 },
                // { "width": '30%', "targets": 2 },
            ],


            // Allows you to scroll right and left if text is to long
            scrollX: true,
            scrollCollapse: true,

            // Show entries length
            lengthMenu: [
                [10, 20, 30, 50],
                [10, 20, 30, 50]
            ],

        });

    });


</script>
@stop
