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
                            <th scope="col">{{ __('STATUS') }}</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($sortedMonitors as $monitor)
                            <tr>
                                <td >#</td>
                                <td ><div class="monitor-info-Wrapper">
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
                                                    <img alt="Avatar" class="table-avatar" src="/images/256x256/256_12.png">
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
                                <td class="project-state">
                                    @if($monitor->status == 1)
                                        <span class="badge badge-success" style="font-size: 100% !important; width: 100%;">Active</span>
                                    @elseif($monitor->status == 2)
                                        <span class="badge" style="background-color: rgb(105, 105, 105); color: white; font-size: 16px">Paused</span>
                                    @endIf
                                </td>
                                <td >
                                    <div class="d-flex">
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
                { "orderable": false, "targets": [0,2,4] },
                { "width": '1%', "targets": 0 },
                { "width": '25%', "targets": 1 },
                { "width": '5%', "targets": 3 },
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
