@extends('adminlte::page')
@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')

<section class="dashboard-header">
    <div class="column">
        <div class="row">
            <div class="col-1 offset-11">
                <a class="btn ">
                    <i class="fas fa-cog"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<section class="dashboard-content">
    <div class="column">
        <div class="row">
            <div class="col-5">
                <div class="card">
                    <div class="card-header" style="background-color: darkcyan; color: white;">
                      <h3 class="card-title">Last check status</h3>
      
                      <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                          <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                          <i class="fas fa-times"></i>
                        </button>
                      </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <div class="info-box-content">
                            <div class="easy-pie-chart-box">
                                <span style="margin: 0 auto;">Up</span>
                                <div class="box">
                                    <div class="chart" id="upChart" data-percent="25">
                                        <span class="percent">12</span>
                                    </div>
                                </div>
                            </div>                      
                            <div class="easy-pie-chart-box">
                                <span style="margin: 0 auto;">Down</span>
                                <div class="box">
                                    <div class="chart" id="downChart" data-percent="45">
                                        <span class="percent">24</span>
                                    </div>
                                </div>
                            </div>
                            <div class="easy-pie-chart-box">
                                <span style="margin: 0 auto;">Paused</span>
                                <div class="box">
                                    <div class="chart" id="pausedChart" data-percent="30">
                                        <span class="percent">15</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>

            <div class="col-7">
                {{-- Will be something --}}
            </div>

            <div class="col-12">
                <div class="card">
                    <div class="card-header" style="background-color: darkcyan; color: white;">
                      <h3 class="card-title">Current status</h3>
      
                      <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                          <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                          <i class="fas fa-times"></i>
                        </button>
                      </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
</section>

@stop

@section('css')
    <link rel="stylesheet" href="/css/app.css">
@stop

@section('js')
{{-- easy-pie-chart --}}
<script src="https://code.jquery.com/jquery-2.2.4.js"></script>  
<script type="text/javascript" src="{{ URL::asset('js/jquery.appear.min.js') }}">></script>
<script type="text/javascript" src="{{ URL::asset('js/jquery.easypiechart.min.js') }}"></script>

    <script src="{{ url('vendor/jquery.min.js') }}"></script>

{{--    <script src="node_modules/chart.js/dist/Chart.bundle.js"></script>--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js" charset="utf-8"></script>

    <script>
               jQuery('#upChart').easyPieChart({
            barColor:'#55c911',
            trackColor:'#d8d7d7f1',
            scaleColor:'#55c911',
            lineWidth: 15,
        });

        jQuery('#downChart').easyPieChart({
            barColor:'#df0505',
            trackColor:'#d8d7d7f1',
            scaleColor:'#df0505',
            lineWidth: 15,
        });


        jQuery('#pausedChart').easyPieChart({
            barColor:'rgba(0, 0, 0, 0.849)',
            trackColor:'#d8d7d7f1',
            scaleColor:'rgba(0, 0, 0, 0.849)',
            lineWidth: 15,
        });
    </script>
@stop
