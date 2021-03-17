@extends('adminlte::page')
@section('title', __('Dashboard'))

@section('content_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
                <a >{{ __('Dashboard')}}</a>
            </li>
        </ol>
    </nav>
@stop

@section('content')

<section class="dashboard-header">
    <div class="column">
        <div class="row">
            <div class="col-12  d-flex justify-content-between">
                <div id='saveInProcess' class="spinner-border text-primary" style="display: none" role="status">
                    <span class="visually-hidden"></span>
                </div>
                <a class="btn save-btn d-flex" id="savePosition">
                    {{ __('Save')}}
                </a>
                <a class="btn " id="settingsBtn">
                    <i class="fas fa-cog"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<section class="dashboard-content">
    <div class="column">
        <div class="row" id="dashboardContentWrappper">
            
        </div>
    </div>



    {{--Add Item Modal Window  --}}
    <div class="modal" tabindex="-1" id="settingsModal" data-backdrop="static">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">{{ __('Add new item')}}</h5>
              <button type="button" class="modal-close" data-bs-dismiss="modal" aria-label="Close" id="modalCloseTopBtn"><i class="fas fa-times-circle"></i></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-4">
                        <label>{{ __('Item type') }}</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-chart-area"></i></span>
                            </div>
                            <select name="itemType" class="form-control select2bs4 select2-hidden-accessible" id='itemType' aria-hidden="true">
                                <option value="areaChart" >{{ __('Response time')}} / {{ __('Download speed')}}</option>
                                <option value="lastChecks">{{ __('Last checks')}}</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div id="ResponseTimeAddWrapper">
                    <div class="row ">
                        <div class="col-sm-4">
                            <label class="mt-10">{{ __('Monitor') }}</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-desktop"></i></span>
                                </div>
                                @if($allItems->first() != null)
                                    <select name="monitor" class="form-control select2bs4 select2-hidden-accessible" id='monitor' aria-hidden="true">
                                        @foreach ($allItems as $item)
                                            @if($item->check_type_name == 'Response speed')
                                                {
                                                    <option value="{{ $item->item_id }}">{{ $item->friendly_name }}</option>
                                                }
                                            @endif
                                        @endforeach
                                    </select>
                                @else
                                    <select name="monitor" class="form-control select2bs4 select2-hidden-accessible" id='monitor' aria-hidden="true" disabled>
                                    </select>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <label class="mt-10">{{ __('Data') }}</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-database"></i></span>
                                </div>
                                @if($allItems->first() != null)
                                    <select name="dataType" class="form-control select2bs4 select2-hidden-accessible" id='dataType' aria-hidden="true" >
                                        <option >{{ __('Response speed')}}</option>
                                        <option >{{ __('Download speed')}}</option>
                                    </select>
                                @else
                                    <select name="dataType" class="form-control select2bs4 select2-hidden-accessible" id='dataType' aria-hidden="true" disabled>
                                        <option >{{ __('Response speed')}}</option>
                                        <option >{{ __('Download speed')}}</option>
                                    </select>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-center" style="margin-top: 30px">
                        <div class="col-sm-8 d-flex justify-content-center">
                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                <label class="btn bg-olive active">
                                  <input type="radio" name="selectedDate" autocomplete="off" value="0" checked=""> {{ __('Today') }}
                                </label>
                                <label class="btn bg-olive">
                                  <input type="radio" name="selectedDate" autocomplete="off" value="2"> {{ __('last 2days') }}
                                </label>
                                <label class="btn bg-olive">
                                  <input type="radio" name="selectedDate" autocomplete="off" value="4"> {{ __('last 4 days') }}
                                </label>
                              </div>
                        </div>
                    </div>

                    <div class="row justify-content-center" style="margin-top: 30px">
                        <div class="col-sm-4 d-flex justify-content-center">
                            <div class="form-group">
                                {{-- Color picker Header background color --}}
                                <div id="cardHeaderBgColor" class="input-group colorBtn" data-color="#008b8b"
                                title="Using data-color attribute in the colorpicker element">
                                    <input type="hidden" class="form-control input-lg"/>
                                    <span class="input-group-append">
                                        <span class="input-group-text colorpicker-input-addon"><i></i></span>
                                    </span>
                                </div>
                                <!-- /.input group -->
                            </div>
                        </div>
                        <div class="col-sm-4 d-flex justify-content-center">
                            <div class="form-group">
                                {{-- Color picker Header text color --}}
                                <div id="cardHeaderTextColor" class="input-group colorBtn" data-color="#fff"
                                title="Using data-color attribute in the colorpicker element">
                                    <input type="hidden" class="form-control input-lg"/>
                                    <span class="input-group-append" >
                                        <span class="input-group-text colorpicker-input-addon"><i></i></span>
                                    </span>
                                </div>
                                <!-- /.input group -->
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-center" >
                        <div class="col-sm-8">
                            <div class="card">
                                <div class="card-header" id="templateChartHeader" style="background-color: darkcyan; color: white;">
                                  <h3 class="card-title" id="templateChartHeaderTitle">test
                                    <span style="font-size:12px">({{ __('Response time')}})</span>
                                  </h3>
                  
                                  <div class="card-tools">
                                    <button type="button" id="templateChartHeaderToolCollapse" style="color: white;"  class="btn btn-tool">
                                      <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" id="templateChartHeaderToolRemove" style="color: white;"  class="btn btn-tool" >
                                      <i class="fas fa-times"></i>
                                    </button>
                                  </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body p-0">
                                    <div class="position-relative mb-4" style="min-height: 153px; padding: 20px 10px 0 10px"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                                        <canvas id="testAreaChart" height="153" width="900" class="chartjs-render-monitor"></canvas>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-sm-4 d-flex justify-content-center">
                            <div class="form-group">
                                {{-- Color picker Header background color --}}
                                <div id="testChartBgColor" class="input-group colorBtn" data-color="rgba(60,141,188,0.2)"
                                title="Using data-color attribute in the colorpicker element">
                                    <input type="hidden" class="form-control input-lg"/>
                                    <span class="input-group-append">
                                        <span class="input-group-text colorpicker-input-addon"><i></i></span>
                                    </span>
                                </div>
                                <!-- /.input group -->
                            </div>
                        </div>
                        <div class="col-sm-4 d-flex justify-content-center">
                            <div class="form-group">
                                {{-- Color picker Header background color --}}
                                <div id="testChartLineColor" class="input-group colorBtn" data-color="#3C8DBC"
                                title="Using data-color attribute in the colorpicker element">
                                    <input type="hidden" class="form-control input-lg"/>
                                    <span class="input-group-append">
                                        <span class="input-group-text colorpicker-input-addon"><i></i></span>
                                    </span>
                                </div>
                                <!-- /.input group -->
                            </div>                    
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="modalCloseBtn"> {{ __('Close')}}</button>
              {{-- Create area chart button, disable button if there is no available items --}}
              @if($allItems->first() != null)
                <button type="button" id="createNewAreaChart" class="btn btn-primary">{{ __('Create')}}</button>
              @else
                <button type="button" id="createNewAreaChart" class="btn btn-primary" disabled>{{ __('Create')}}</button>
              @endif
              <button type="button" id="createNewLastStatusBtn" style="display: none" class="btn btn-primary">{{ __('Create')}}</button>
            </div>
          </div>
        </div>
      </div>
</section>

@stop

@section('css')
    <link rel="stylesheet" href="/css/app.css">
    <link href="/css/adminlte/user_admin/dashboard.css" rel="stylesheet">

    {{-- Bootstrap color picker styles --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/3.2.0/css/bootstrap-colorpicker.min.css">

    {{-- Toastr styles --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" media="all">
@stop

@section('js')
    
    {{-- easy-pie-chart --}}
    <script type="text/javascript" src="{{ URL::asset('js/jquery.appear.min.js') }}">></script>
    <script type="text/javascript" src="{{ URL::asset('js/jquery.easypiechart.min.js') }}"></script>

    {{--Chart js--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js" charset="utf-8"></script>

    {{-- Color picker --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/3.2.0/js/bootstrap-colorpicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
        
    {{-- toastr --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    {{-- Swal --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.14.0/sweetalert2.min.js"></script>
    
    {{-- JQuery UI  --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
    <script>
         $(function(){
            $('#dashboardContentWrappper').sortable({
                // connectWith: '#out-of-stock',
            });

            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });
            let monitorItems = <?php echo $allItems; ?>;
            let testAreaChart;
            let areaChartNr = 0;
            let numb = 0;
            let lastElementPosition = <?php echo json_encode($lastElementPosition); ?>;

            //FUNCTIONS
            function getStartDashboard(){
                $('#settingsModal').hide();
                let allDashboardElements = <?php echo json_encode($allDashboardItems); ?>;

                for(const property in allDashboardElements){
                    const elementType = allDashboardElements[property]['type'];

                    switch(elementType){
                        case 'currentStatus':
                            const elementId = allDashboardElements[property]['id'];
                            const lastCheckStatus = allDashboardElements[property]['currentStatus'];

                            createLastChecksChart(lastCheckStatus,elementId);
                            break;
                        case 'areaChart':
                            const chartData = allDashboardElements[property];

                            costumizeDataForAreaChart(chartData);
                            break;
                        default:
                            console.log(`Sorry, we are out of something.`);
                    }

                }          

            }

            getStartDashboard();

            function noDataItem(newHystory){
                let itemId = newHystory['itemColors']['color_id'];
                let monitorName = newHystory['monitorName'];
                let dataTypeName = newHystory['dataType'];

                let itemNoData = `
                        <div class="col-md-6" id="${itemId}">
                        <div class="card">
                            <div class="card-header" >
                                <h3 class="card-title">${monitorName}<span style="font-size:12px">  (${dataTypeName})</span></h3>
                
                                <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" id="itemRemove${itemId}" class="btn btn-tool" >
                                    <i class="fas fa-times"></i>
                                </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <div class="infoWrapper">
                                    <i class="fas fa-bomb"></i>
                                    <div class="infoWrapper-decription">
                                        ${ @json( __("Sorry, no data to display"))}
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                `;

                const position = "beforeend";

                const dashboardContent = document.getElementById('dashboardContentWrappper');
                dashboardContent.insertAdjacentHTML(position, itemNoData);

                //Remove item
                const itemWrapper = $(`#${itemId}`);
                $(`#itemRemove${itemId}`).on( "click", function() {
                    removeItem(itemId);
                    itemWrapper.remove();
                });
            }

            //Create area chart
            function createAreaChart(newHystory){
                let itemId = newHystory['itemColors']['color_id'];
                let cardHeaderTextColor = newHystory['itemColors']['header_text_color'];
                let cardHeaderBgColor = newHystory['itemColors']['header_background_color'];
                let chartBgColor = newHystory['itemColors']['chart1_background_color'];
                let chartLineColor = newHystory['itemColors']['chart1_border_color'];
                let monitorName = newHystory['monitorName'];
                let dataTypeName = newHystory['dataType'];

                areaChartHtml = `<div class="col-sm-6" id="${itemId}">
                                    <div class="card">
                                        <div class="card-header" id="areaChartHeader${areaChartNr}" style="background-color: ${cardHeaderBgColor}; color: ${cardHeaderTextColor};">
                                            <h3 class="card-title">${monitorName}<span style="font-size:12px">  (${dataTypeName})</span></h3>
                            
                                            <div class="card-tools">
                                            <button type="button" id="areaChartHeaderToolCollapse${areaChartNr}" style="color: ${cardHeaderTextColor};" class="btn btn-tool" data-card-widget="collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                            <button type="button" id="areaChartHeaderToolRemove${areaChartNr}" style="color: ${cardHeaderTextColor};" class="btn btn-tool" >
                                                <i class="fas fa-times"></i>
                                            </button>
                                            </div>
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body p-0">
                                            <div class="position-relative mb-4" style="min-height: 153px; padding: 20px 10px 0 10px"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                                                <canvas id="areaChart${areaChartNr}" height="153" width="900" class="chartjs-render-monitor"></canvas>
                                            </div>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                </div>`

                const position = "beforeend";

                const dashboardContent = document.getElementById('dashboardContentWrappper');
                dashboardContent.insertAdjacentHTML(position,areaChartHtml);

                // Get context with jQuery - using jQuery's .get() method.
                let areaChartCanvas = $(`#areaChart${areaChartNr}`).get(0).getContext('2d');
                    
                let areaChartData = {
                    labels  : newHystory['clock'],
                    
                    datasets: [
                    {
                        label               : 'Download speed(KBps)',
                        backgroundColor     : chartBgColor,
                        borderColor         : chartLineColor,
                        pointRadius          : true,
                        pointColor          : '#3b8bba',
                        pointStrokeColor    : 'rgba(60,141,188,1)',
                        pointHighlightFill  : '#fff',
                        pointHighlightStroke: 'rgba(60,141,188,1)',
                        data                : newHystory['values'],
                        fill: true,
                        pointRadius: 1,
                        pointHoverRadius: 1,
                        pointBackgroundColor: 'white',
                    }
                    ]
                };

                let areaChartOptions = {
                    maintainAspectRatio : false,
                    responsive : true,
                    legend: {
                        display: false
                    },
                   
                        datalabels: {
                            display: false,
                        },
                    scales: {
                        xAxes: [{
                            gridLines : {
                                display : false,
                            },
                            ticks: {
                                display: false
                            }
                        }],
                        yAxes: [{
                            gridLines : {
                                display : false,
                            },
                            ticks: {
                                beginAtZero: true,   // minimum value will be 0.
                                // steps: 10,
                                // stepValue: 5,
                                // max: 11
                            }
                        }]
                    }
                    
                }
                
                // This will get the first returned node in the jQuery collection.
                areaChart = new Chart(areaChartCanvas, { 
                    type: 'line',
                    data: areaChartData, 
                    options: areaChartOptions
                })
                
                //Remove item
                let itemWrapper = $(`#${itemId}`);
                $(`#areaChartHeaderToolRemove${areaChartNr}`).on( "click", function() {
                    removeItem(itemId);
                    itemWrapper.remove();
                });
                
                areaChartNr++;
            }


            function createLastChecksChart(statusValues,elementId){

                let lastCheckGraph = `
                                    <div class="col-6" id="${elementId}">
                                    <div class="card">
                                        <div class="card-header" style="background-color: #008b8b; color: white;">
                                            <h3 class="card-title">Last check status</h3>
                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool" style="color: white;" data-card-widget="collapse">
                                                <i class="fas fa-minus"></i>
                                                </button>
                                                <button type="button" id="currentStatusRemoveBtn${elementId}" class="btn btn-tool" style="color: white;" >
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
                                                        <div class="chart" id="upChart${numb}" data-percent="${ statusValues['percentage']['up'] }">
                                                            <span class="percent">${ statusValues['values']['up'] }</span>
                                                        </div>
                                                    </div>
                                                </div>                      
                                                <div class="easy-pie-chart-box">
                                                    <span style="margin: 0 auto;">Down</span>
                                                    <div class="box">
                                                        <div class="chart" id="downChart${numb}" data-percent="${ statusValues['percentage']['down'] }">
                                                            <span class="percent">${ statusValues['values']['down'] }</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="easy-pie-chart-box">
                                                    <span style="margin: 0 auto;">Paused</span>
                                                    <div class="box">
                                                        <div class="chart" id="pausedChart${numb}" data-percent="${ statusValues['percentage']['paused'] }">
                                                            <span class="percent">${ statusValues['values']['paused'] }</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                </div>`;

                const position = "beforeend";

                const dashboardContent = document.getElementById('dashboardContentWrappper');
                dashboardContent.insertAdjacentHTML(position,lastCheckGraph);


                //Pie chart
                jQuery('#upChart'+numb).easyPieChart({
                    barColor:'#55c911',
                    trackColor:'#d8d7d7f1',
                    scaleColor:'#55c911',
                    lineWidth: 15,
                });

                jQuery('#downChart'+numb).easyPieChart({
                    barColor:'#df0505',
                    trackColor:'#d8d7d7f1',
                    scaleColor:'#df0505',
                    lineWidth: 15,
                });


                jQuery('#pausedChart'+numb).easyPieChart({
                    barColor:'rgba(0, 0, 0, 0.849)',
                    trackColor:'#d8d7d7f1',
                    scaleColor:'rgba(0, 0, 0, 0.849)',
                    lineWidth: 15,
                });

                let itemWrapper = $(`#${elementId}`);
                $(`#currentStatusRemoveBtn${elementId}`).on( "click", function() {
                    removeItem(elementId);
                    itemWrapper.remove();
                });

                numb++;
            }



            //ELEMENT CREATE
            
            //Pie chart
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
            
            //color picker create with addon
            $('#cardHeaderBgColor').colorpicker(
                {
                    options: {
                        format: 'rgb',
                        namesAsValues: true,
                        autoInputFallback : true,
                        horizontal : true
                    }
                }
            );

            //color picker create with addon
            $('#cardHeaderTextColor').colorpicker(
                {
                    options: {
                        namesAsValues: true,
                        autoInputFallback : true
                    }
                }
            );

            //color picker create with addon
            $('#testChartBgColor').colorpicker(
                {
                    options: {
                        namesAsValues: true,
                        autoInputFallback : true
                    }
                }
            );

            //color picker create with addon
            $('#testChartLineColor').colorpicker(
                {
                    options: {
                        namesAsValues: true,
                        autoInputFallback : true
                    }
                }
            );


            //EVENT LISTENERS
            $('#cardHeaderTextColor').on('colorpickerChange', function(event) {
                $('#cardHeaderTextColor .fa-square').css('color', event.color.toString())
                $('#templateChartHeaderTitle').css("color", event.color.toString());
                $('#templateChartHeaderToolCollapse').css("color", event.color.toString());
                $('#templateChartHeaderToolRemove').css("color", event.color.toString());
            });

            $('#cardHeaderBgColor').on('colorpickerChange', function(event) {
                $('#cardHeaderBgColor .fa-square').css('color', event.color.toString());
                $('#templateChartHeader').css("background-color", event.color.toString());
            });

            $('#testChartBgColor').on('colorpickerChange', function(event) {
                $('#testChartBgColor .fa-square').css('color', event.color.toString());
                testAreaChart.data.datasets[0].backgroundColor = event.color.toString();
                testAreaChart.update();
            });

            $('#testChartLineColor').on('colorpickerChange', function(event) {
                $('#testChartLineColor .fa-square').css('color', event.color.toString());
                testAreaChart.data.datasets[0].borderColor = event.color.toString();
                testAreaChart.update();
            });

            $('#settingsBtn').click( function(){
                $('#settingsModal').show();
            });

            $('#modalCloseBtn').click( function(){
                $('#settingsModal').hide();
            });

            $('#modalCloseTopBtn').click( function(){
                $('#settingsModal').hide();
            });

            $('#monitor').change( function(){
                let typeOfData = $('#dataType option:selected').text();
                let selectedMonitorName = $('#monitor option:selected').text();
                $('#templateChartHeaderTitle').html(selectedMonitorName+ `<span style="font-size:12px">(  ${typeOfData})</span>`);
            });

            $('#dataType').change( function(){
                $('#monitor').empty();

                for (const property in monitorItems) {
                    if($('#dataType').val() == monitorItems[property]['check_type_name']){
                        $('#monitor').append(`<option value="${monitorItems[property]['item_id']}"> 
                                       ${monitorItems[property]['friendly_name']} 
                                  </option>`); 
                    }
                }

                let typeOfData = $('#dataType option:selected').text();
                let selectedMonitorName = $('#monitor option:selected').text();
                $('#templateChartHeaderTitle').html(selectedMonitorName+ `<span style="font-size:12px">(  ${typeOfData})</span>`);
            });

            $('#savePosition').click( function(){
                $('#saveInProcess').css("display", "block");
                $('#savePosition').addClass('d-none');
                saveDashboardElamentsPositions();
            });
            $('#createNewAreaChart').click( function(){
                let itemId = $('#monitor option:selected').val();
                let date =$("input[name='selectedDate']:checked").val();

                let date_type = $('#dataType').val();

                let itemColors = {
                    'header_text_color' : $('#cardHeaderTextColor input').val(),
                    'header_background_color' : $('#cardHeaderBgColor input').val(),
                    'chart1_background_color' : $('#testChartBgColor input').val(),
                    'chart1_border_color' : $('#testChartLineColor input').val()
                }

                let monitorName = $('#monitor option:selected').text()


                createNewAreaChartItem(itemId, date, date_type, itemColors, monitorName);
                $('#settingsModal').hide();
            });

            $('#createNewLastStatusBtn').click( function(){
                createNewLastStatusCheck();
                $('#settingsModal').hide();
            });

            $("input[name='itemType']:checked").val()

            $('#itemType').change( function(){

                let itemType = $("select option:selected").val();

                if('areaChart' == itemType){
                    $('#ResponseTimeAddWrapper').css('display','block');
                    $('#createNewAreaChart').css('display','block');
                    $('#createNewLastStatusBtn').css('display','none');
                }else if('lastChecks' == itemType){
                    $('#ResponseTimeAddWrapper').css('display','none');
                    $('#createNewAreaChart').css('display','none');
                    $('#createNewLastStatusBtn').css('display','block');
                }else{
                    $('#ResponseTimeAddWrapper').css('display','none');
                    $('#createNewAreaChart').css('display','none');
                    $('#createNewLastStatusBtn').css('display','none');
                }
            });


            function costumizeDataForAreaChart(newData){

                let values = [];
                let clock = [];
                let currentValue = 0;

                if(newData['histories'] != null && newData['histories'].length > 1){
                    for (const property in newData['histories']) {
                        if(newData['dataType'] == 'Download speed'){
                            currentValue = newData['histories'][property]['value'];
                            values[property] = Math.round((currentValue / 1000) * Math.pow(10, 2)) / Math.pow(10, 2);
                        }else{
                            currentValue = newData['histories'][property]['value'];
                            values[property] = Math.round((currentValue) * Math.pow(10, 4)) / Math.pow(10, 4);
                        }
                    clock[property] =  new Date(newData['histories'][property]['clock']*1000);
                    clock[property] = moment(clock[property]).format("DD/MM/YY HH:mm");
                    }
                    let newHystory = {
                        'values' : values,
                        'clock' : clock,
                        'itemColors' : newData['itemColors'],
                        'monitorName' : newData['monitorName'],
                        'dataType' : newData['dataType']
                    };
                    createAreaChart(newHystory);
                } else{
                    noDataItem(newData);
                }
            }


            function createNewAreaChartItem(itemId, date, data_type, itemColors, monitorName){
                lastElementPosition++;
                $.ajax( {
                type:'POST',
                header:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ URL::route("user.dashboard.newAreaChartStore") }}',
                data:{
                _token: "{{ csrf_token() }}",
                dataType: 'json', 
                contentType:'application/json',
                // My data
                itemId: itemId,
                date: $("input[name='selectedDate']:checked").val(),
                data_type: $('#dataType').val(),
                item_colors: itemColors,
                monitorName: monitorName,
                createdElementPosition: lastElementPosition
                }


                })
                .done(function(data) {
                    let values = [];
                    let clock = [];
                    let currentValue = 0;
                    if(data['histories'] != null){
                        costumizeDataForAreaChart(data);
                        toastr.success( @json( __('New item was created successfully!')  ));
                    }else{
                        noDataItem(data);
                    }

                })
                .fail(function() {
                    toastr.error( @json( __('Something whent wrong!')  ));
                });
            }

            function createNewLastStatusCheck(){
                lastElementPosition++;
                $.ajax( {
                type:'POST',
                header:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ URL::route("user.dashboard.lastStatusHistoryGet") }}',
                data:{
                _token: "{{ csrf_token() }}",
                dataType: 'json', 
                contentType:'application/json',
                createdElementPosition: lastElementPosition
                }


                })
                .done(function(data) {
                    createLastChecksChart(data['currentStatus'],data['currentStatus']['id']);
                    toastr.success( @json( __('New item was created successfully!')  ));
                })
                .fail(function() {
                    toastr.error( @json( __('Something whent wrong!')  ));
                });
            }

            function removeItem(itemId){
                $.ajax( {
                type:'POST',
                header:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ URL::route("user.dashboard.itemRemove") }}',
                data:{
                _token: "{{ csrf_token() }}",
                dataType: 'json', 
                contentType:'application/json',
                // My data
                itemId: itemId,
                }


                })
                .done(function(data) {
                    toastr.success( @json( __('Item has been removed!')  ));
                })
                .fail(function() {
                    toastr.error( @json( __('Something whent wrong!')  ));
                });
            }

            function saveDashboardElamentsPositions(){
 
                let allDashboadrElement =  $('#dashboardContentWrappper').children();
                let elementsIds = [];
                
                for(let i=0;i<allDashboadrElement.length;i++){
                    elementsIds[i] = allDashboadrElement[i].id;
                }

                $.ajax( {
                type:'POST',
                header:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ URL::route("user.dashboard.savePosition") }}',
                data:{
                _token: "{{ csrf_token() }}",
                dataType: 'json', 
                contentType:'application/json',
                // My data
                elementsIds: elementsIds,
                }


                })
                .done(function(data) {
                    $('#saveInProcess').css("display", "none");
                    $('#savePosition').removeClass('d-none');
                    toastr.success( @json( __('All has been saved!')  ));
                })
                .fail(function() {
                    $('#saveInProcess').css("display", "none");
                    $('#savePosition').removeClass('d-none');
                    toastr.error( @json( __('Something whent wrong!')  ));
                });
            }




//Create area chart
      // function chartIt(){
      // Get context with jQuery - using jQuery's .get() method.
      var testAreaChartCanvas = $('#testAreaChart').get(0).getContext('2d');
          
      var testAreaChartData = {
          labels  : [1,2,3,4,5],
          datasets: [
          {
              label               : 'Download speed(KBps)',
              backgroundColor     : 'rgba(60,141,188,0.2)',
              borderColor         : 'rgba(60,141,188,0.9)',
              pointRadius          : true,
              pointColor          : '#3b8bba',
              pointStrokeColor    : 'rgba(60,141,188,1)',
              pointHighlightFill  : '#fff',
              pointHighlightStroke: 'rgba(60,141,188,1)',
              data                : [10,13,8,12,14],
              fill: true,
              pointRadius: 1,
              pointHoverRadius: 1,
              pointBackgroundColor: 'white',
          }
        ]
      };
    
      var testAreaChartOptions = {
          animation: false,
          maintainAspectRatio : false,
          responsive : true,
          legend: {
          display: false
          },
          scales: {
            xAxes: [{
                gridLines : {
                display : true,
                }
            }],
            yAxes: [{
              gridLines : {
                display : false,
              },
              ticks: {
                  beginAtZero: true   // minimum value will be 0.
              }
            }]
          }
          
      }
    
      // This will get the first returned node in the jQuery collection.
      testAreaChart = new Chart(testAreaChartCanvas, { 
          type: 'line',
          data: testAreaChartData, 
          options: testAreaChartOptions
      })

      testAreaChart.resize();


        testAreaChart.data.datasets[0].data = [10,13,8,12,14];
        testAreaChart.data.labels = [1,2,3,4,5];
        testAreaChart.update();
        testAreaChart.resize();
         });
    </script>
@stop
