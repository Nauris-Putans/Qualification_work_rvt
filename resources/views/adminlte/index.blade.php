@extends('adminlte::page')
@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <br>
    <div class="container">
        <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-area-chart"></i>
                Blog Posting Trend
            </div>
            <div class="card-body">
                <canvas id="myAreaChart" width="100%" height="30"></canvas>
            </div>
            <div class="car-footer small text-muted">Updated yesterday at 11:59 PM</div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script src="{{ url('vendor/jquery.min.js') }}"></script>

{{--    <script src="node_modules/chart.js/dist/Chart.bundle.js"></script>--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js" charset="utf-8"></script>

    <script>
        let myAreaChart = document.getElementById('myAreaChart').getContext('2d');

        let massPopChart = new Chart(myAreaChart, {
            type:'bar', // bar, horizontalBar, pie, line, doughnut, radar, polarArea
            data:{
                labels:['Celtics', 'Lakers', 'Heat', 'Clippers'],
                datasets:[{
                    label: 'Win rate %',
                    data:[
                        56,
                        60,
                        55,
                        40
                    ]
                }]
            },
            options:{},
        });
    </script>
@stop
