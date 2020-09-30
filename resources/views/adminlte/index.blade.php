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
                NBA team win rate(%)
            </div>
            <div class="card-body">
                <canvas id="myAreaChart" width="100%" height="40"></canvas>
            </div>
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

        // Global Options
        Chart.defaults.global.defaultFontFamily = 'Source Sans Pro';
        Chart.defaults.global.defaultFontSize = 18;
        Chart.defaults.global.defaultFontColor = '#777';

        // Colors
        $green = '#008000';
        $yellow = '#ffff00';
        $red = '#ff0000';
        $white = '#ffffff';

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
                    ],
                    backgroundColor: [
                        $green,
                        $yellow,
                        $red,
                        $white
                    ],
                    borderWidth:1,
                    borderColor: '#777',
                    hoverBorderWidth:3,
                    hoverBorderColor: 'black'
                }]
            },
            options:{
                legend:{
                    display:false,
                    position:'right',
                    labels:{
                        fontColor:'black'
                    }
                },
                layout:{
                    padding:{
                        left:50,
                        right:0,
                        bottom:0,
                        top:0
                    }
                }
            },
        });
    </script>
@stop
