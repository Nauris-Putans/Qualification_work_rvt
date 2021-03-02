@extends('adminlte::page')
@section('title', 'Download speed')

@section('content_header')
    <h1>{{ __('Monitoring')}} > {{ __('Download speed')}}</h1>
@stop


@section('content')

<section class="response-time">   
    {{-- column start --}}
    <div class="column">

      {{-- Response time page settings --}}
      <div class="row">
        <div class="col-md-3">
          <label>{{ __('Monitor') }}</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-desktop"></i></span>
            </div>
            <select class="form-control" id='userMonitors'>
              {{-- Here will be automatic generated options --}}
            </select>
          </div>
        </div>
        {{-- Date settings --}}
        <div class="col-md-3">
          <label>{{ __('Date') }}</label>
          <i ${lastCheckIcon} id="lastCheckIcon"></i>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">
                <i class="far fa-calendar-alt"></i>
              </span>
            </div>
            <input type="text" class="form-control float-right" name="datefilter" value="" id="datePicker">
          </div>
        </div>
        {{-- Time settings --}}
        <div class="col-md-3">
          <label>{{ __('Time') }}</label>
          <div class="input-group">
            <button class="btn time-btn" id="timeButton">
              <i class="fas fa-clock" style="height: 100%; width: auto;"></i>
            </button>
            {{-- time settings container --}}
            <div class="time-content" id="timeSelectBox">
              <div class="select-time">
                <div class="time_picker_box">
                  <div class="label">{{ __('Start time') }}</div>
                  <div class="time-picker" data-time="00:00">
                    <div class="hour">
                      <div class="hr-up"></div>
                      <input type="number" class="hr" value="00">
                      <div class="hr-down"></div>
                    </div>
        
                    <div class="separator">:</div>
        
                    <div class="minute">
                      <div class="min-up"></div>
                      <input type="number" class="min" value="00">
                      <div class="min-down"></div>
                    </div>
                  </div>
                </div>
  
                <div class="time_picker_box">
                  <div class="label">{{ __('End time') }}</div>
                  <div class="time-picker" data-time="00:00">
                    <div class="hour">
                      <div class="hr-up"></div>
                      <input type="number" class="hr" value="23">
                      <div class="hr-down"></div>
                    </div>
        
                    <div class="separator">:</div>
        
                    <div class="minute">
                      <div class="min-up"></div>
                      <input type="number" class="min" value="59">
                      <div class="min-down"></div>
                    </div>
                  </div>
                </div>
              </div>
            
              <button type="button" class="btn btn-success" id="selectTime" style="margin: 0 auto; display: block">{{ __('Select') }}</button>

            </div>
            {{--END  time settings container --}}
          </div>    
      </div>
    </div>


  {{-- Response time page info Boxes --}}
  <div class="row" id="responseTimeInfoBoxes" >
    <div class="col-md-3">
      <div class="info-box">
        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">{{ __('Requests') }}</span>
          <span class="info-box-number" id="requests">
              {{-- Requests number --}}
          </span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-3">
      <div class="info-box mb-3">
        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-thumbs-up"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">{{ __('Fast speed') }}</span>
          <span class="info-box-number" id="maxTime">
              {{-- Check min response time --}}
          </span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->

    <!-- fix for small devices only -->
    <div class="clearfix hidden-md-up"></div>

    <div class="col-md-3">
      <div class="info-box mb-3">
        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-wave-square"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">{{ __('Average speed') }}</span>
          <span class="info-box-number" id="averageTime">
              {{-- Check average response time --}}
          </span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-3">
      <div class="info-box mb-3">
        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-down"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">{{ __('Low speed') }}</span>
          <span class="info-box-number" id="minTime">
              {{-- Check the biggest response time --}}
          </span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
  </div>


      <div class="row">
        <div class="col-md-8 col-md-12" id="responseChart">
          <div class="card">
            <div class="card-header" style="background-color:white;">
              <div class="d-flex justify-content-between">
                <h3 class="card-title">{{ __('Download speed(KBps)') }}</h3>
                  <div class="card-tools">
                    {{-- <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </button> --}}
                    <button type="button" class="btn btn-tool" id="resize_btn"><i id="resize_icon" class="fas fa-compress-alt"></i></button>
                  </div>
              </div>
            </div>
            <div class="card-body">

            <div class="d-flex">
              <p class="ml-auto d-flex flex-column text-right">
                <span class="text-success" id="lastCheckValue">
                  <i ${lastCheckIcon} id="lastCheckIcon"></i>
                </span>
                <span class="text-muted">{{ __("Last check's value change") }}</span>
              </p>
            </div>
            <!-- /.d-flex -->

            <div class="position-relative mb-4"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
              <canvas id="areaChart" height="257px" width="1128" class="chartjs-render-monitor" style="display: block; min-height: 257px; width: 903px;"></canvas>
            </div>

            </div>   
          </div>
        </div>

        {{-- Weekday average response time Start--}}
        <div class="col-md-4" id="weekdayChartBox">
          <div class="card" style = "height : 435px">
            <div class="card-header d-flex justify-content-center">
              <div class="btn-group btn-group-toggle" data-toggle="buttons">
                <label class="btn bg-olive">
                  <input type="radio" name="options" id="radioOption1" autocomplete="off" checked=""> {{ __('Weekday') }}
                </label>
                <label class="btn bg-olive active">
                  <input type="radio" name="options" id="radioOption2" autocomplete="off"> Day's parts
                </label>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0" style="height: 300px;">
              <canvas id="WeekDayChart" height="90%" width="90%" class="chartjs-render-monitor" style="display: block; height: 200px; width: 903px;"></canvas>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        {{-- Weekday average response time END--}}

    </div>
 
    <div class="row d-none" id="infoAlert" style="margin-top: 10px">
      <div class="col-md-12">
        <div class="callout callout-warning" style="width: 100%">
          <h5>{{ __('Info!') }}</h5>

          <p>{{ __('At the moment, there is no data yet.') }}</p>
        </div>
      </div>
    </div>
  </div>
    {{-- column end --}}
</section>


@stop

@section('css')
<link rel="stylesheet" href="/css/app.css">
<link href="/css/userAdmin.css" rel="stylesheet">
{{-- Data picker style --}}
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@stop

@section('js')
{{-- Data,tyme picker scripts --}}
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

{{--    <script src="node_modules/chart.js/dist/Chart.bundle.js"></script>--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js" charset="utf-8"></script>
<script>
  $(function () {  

    //Global variables
    let friendlyNameCounter = 0;
    let currentFriendlyNameSelected = '';
    let checkCounter = 0;
    let endDate = new Date();
    let startDate = new Date(endDate);
    let currentHistory;
    let currentChartType = 0;
    let checkItemsIds;
    let emptyHistory = 1;

    startDate.setDate(startDate.getDate() - 1);
    startDate.setHours(0);
    startDate.setMinutes(0);
    endDate.toDateString();
    startDate.toDateString();

    //Insert new Date to date rang picker
    $('#datePicker').daterangepicker({ startDate:  startDate, endDate: endDate });

    startDate = Math.floor(Date.parse(startDate) / 1000);
    endDate = Math.floor(Date.parse(endDate) / 1000);

    //Function that display new info to info labels,boxes
    function displayNewInfo(responseSpeedMS,checkCount){
        OldLastCheckValue = document.getElementById('lastCheckIcon');

        OldLastCheckValue.remove();
        $("#lastCheckValue").text('');

        lastCheckValue = document.getElementById('lastCheckValue');
        lastChecksDiference = responseSpeedMS[checkCount-1] - responseSpeedMS[checkCount-2];
        let lastCheckIcon ;
        if(lastChecksDiference<0){
            lastCheckIcon ='class="fas fa-arrow-down" style="color:green"';
        }else if(lastChecksDiference>0)
        {
            lastCheckIcon ='class="fas fa-arrow-up" style="color:red"';
        }else{

        }
        $("#requests").text(checkCount);
        let newValue =`
                <i ${lastCheckIcon} id="lastCheckIcon"></i>${Math.round(lastChecksDiference * Math.pow(10, 2)) / Math.pow(10, 2)}
                `;
        const position = "beforeend";
        lastCheckValue.insertAdjacentHTML(position,newValue);
    } 

    //Check that user have any monitor or data hystory
    function userDataCheck(newresponseTime,newfriendlyNames,dropDownVal){

      let responseTimeInfoBoxes = document.getElementById("responseTimeInfoBoxes");
      let responseChart = document.getElementById("responseChart");
      let weekDayChartBox = document.getElementById("weekdayChartBox");
      let infoAlert = document.getElementById("infoAlert");

      if(newfriendlyNames.length === 0){
        $('#userMonitors').attr('disabled', 'disabled');
        $('#datePicker').attr('disabled', 'disabled');
        $('#timeButton').attr('disabled', 'disabled');
      }else{
        $('#userMonitors').removeAttr('disabled');
        $('#datePicker').removeAttr('disabled');
        $('#timeButton').removeAttr('disabled');
      }

      if(Object.keys(newresponseTime).length < 2 ){
        if(responseTimeInfoBoxes.classList.toggle("d-none") === true){
          responseChart.classList.toggle("d-none");
          weekDayChartBox.classList.toggle("d-none");
          infoAlert.classList.toggle("d-none");
        }else{
          responseTimeInfoBoxes.classList.toggle("d-none");

        }

        addOptionsToDropDown(newfriendlyNames, dropDownVal);
      }else{
        if(responseTimeInfoBoxes.classList.toggle("d-none") === true){
          responseTimeInfoBoxes.classList.toggle("d-none");
        }else{
          responseChart.classList.toggle("d-none");
          weekDayChartBox.classList.toggle("d-none");
          infoAlert.classList.toggle("d-none");
        }
        insertData(newresponseTime);

        addOptionsToDropDown(newfriendlyNames, dropDownVal);
      }
    }

    //Get values from controller MonitoringPageSpeedController
    function setData(){
        let checkHistory = <?php echo json_encode($histories); ?>;
        let checkFriendlyName = <?php echo json_encode($itemsFriendlyName); ?>;
        let checkItemsIds = <?php echo json_encode($itemsIds); ?>;

        currentHistory = checkHistory;
        optionSelectedId = [];

        if(Object.keys(checkFriendlyName).length != 0){
          optionSelectedId =['item'];
          optionSelectedId['item'] = checkItemsIds[0]['item'];
          //Will be set as current value in drop down box
          let checkLastFriendlyName = checkItemsIds[0].item_id;
          userDataCheck(checkHistory,checkFriendlyName,checkLastFriendlyName);
        }else{
          $('#userMonitors').attr('disabled', 'disabled');
          $('#datePicker').attr('disabled', 'disabled');
          $('#timeButton').attr('disabled', 'disabled');
          let weekDayChartBox = document.getElementById('weekdayChartBox');
          if(responseTimeInfoBoxes.classList.toggle("d-none") === true){
            responseChart.classList.toggle("d-none");
            weekDayChartBox.classList.toggle("d-none");
            infoAlert.classList.toggle("d-none");
          }else{
            responseTimeInfoBoxes.classList.toggle("d-none");
          }
        }

    }

    //Create createweekDayChart 
    let weekDayChart;
      var barChartCanvas = $('#WeekDayChart').get(0).getContext('2d');
      Chart.defaults.global.elements.point.pointStyle = 'rectRounded';
      Chart.defaults.global.elements.rectangle.borderSkipped = "right";
      var weekDayChartData        = {
        labels: [
            'Monday',
          

        ],
        datasets: [
          {
            data: [0.001],
            backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de', '#00a65a'],
          }
        ]
      }
      var weekDayChartOptions = {

        legend: {
          display: false
        },
        animation: {
          animateScale: true,
        },
        layout: {
              padding: {
                  left: 20,
                  right: 20,
                  top: 0,
                  bottom: 0
              }
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
        },
        maintainAspectRatio : false,
        responsive : true,
        animation: {
          duration: 1000 // general animation time
        },
        hover: {
            animationDuration: 0 // duration of animations when hovering an item
        },

        cornerRadius: 20,
        layout: {
          padding: {
              left: 50,
              right: 50,
              top: 20,
              bottom: 20
          }
        }
      }

      weekDayChart = new Chart(barChartCanvas, {
        type: 'bar', 
        data: weekDayChartData,
        options: weekDayChartOptions
      })


      //Costomize and insert new data to Weekday chart
      function insertDataToWeekdayChart(responseSpeed,ResponseClock){
        let weekdayCounter = [0,0,0,0,0,0,0];

        let weekdayResponseTimeSum = [0,0,0,0,0,0,0];

        let weekday = new Array(7);
        weekday[0] = @json( __("Sunday")  );
        weekday[1] = @json( __("Monday")  );
        weekday[2] = @json( __("Tuesday")  );
        weekday[3] = @json( __("Wednesday")  );
        weekday[4] = @json( __("Thursday")  );
        weekday[5] = @json( __("Friday")  );
        weekday[6] = @json( __("Saturday")  );

        let i=0;
        let b=0;
        let newDate;
        while(ResponseClock[i] != null){
          newDate = new Date(ResponseClock[i]*1000);
          b=0;
          for(b;b<7;b++){

            if(weekday[newDate.getDay()] == weekday[b]){
              weekdayCounter[b]++;
              weekdayResponseTimeSum[b] += Math.round((responseSpeed[i]) * Math.pow(10, 2)) / Math.pow(10, 2);
              break;
            }
          }
          
          i++;
        }   
        let chartDataLabels =[];
        let chartDataAvarageTime =[];

        for(let a=0;a<7;a++){
          if(weekdayResponseTimeSum[a] != 0){
            weekdayResponseTimeSum[a] /= weekdayCounter[a];
            weekdayResponseTimeSum[a] = Math.round(weekdayResponseTimeSum[a] * Math.pow(10, 2)) / Math.pow(10, 2);
            chartDataLabels.push(weekday[a]);
            chartDataAvarageTime.push(weekdayResponseTimeSum[a]);
          }
        }  

        weekDayChart.data.datasets[0].data = chartDataAvarageTime;
        weekDayChart.data.labels = chartDataLabels;
        weekDayChart.update();
        weekDayChart.resize();
      }

      function insertDataToDayPartChart(responseSpeed,ResponseClock){
        let dayParts = new Array(3);
        dayParts[0] = @json( __('Morning')  );
        dayParts[1] = @json( __('Afternoon')  );
        dayParts[2] = @json( __('Evening')  );

        let dayPartsValues = [0,0,0];
        let dayPartsValuesCount = [0,0,0];
        let chartDataAvarageTime = new Array();
        let chartDataLabels = new Array();

        let i;
        for( i=0; i<responseSpeed.length; i++){
          ResponseClock[i] = new Date(ResponseClock[i]*1000);
          
          if(ResponseClock[i].getHours() > 0 && ResponseClock[i].getHours() < 12){
            dayPartsValues[0] += responseSpeed[i];
            dayPartsValuesCount[0]++;
          } else if(ResponseClock[i].getHours() == 12){
            if(ResponseClock[i].getMinutes() == 0){
              dayPartsValues[0] += responseSpeed[i];
              dayPartsValuesCount[0]++;
            } else{
              dayPartsValues[1] += responseSpeed[i];
              dayPartsValuesCount[1]++;
            }
          } else if(ResponseClock[i].getHours() > 12 && ResponseClock[i].getHours() < 18){
            dayPartsValues[1] += responseSpeed[i];
            dayPartsValuesCount[1]++;
          } else if(ResponseClock[i].getHours() == 18){
            if(ResponseClock[i].getMinutes() == 0){
              dayPartsValues[1] += responseSpeed[i];
              dayPartsValuesCount[1]++;
            } else{
              dayPartsValues[2] += responseSpeed[i];
              dayPartsValuesCount[2]++;
            }
          } else if(ResponseClock[i].getHours() > 18 && ResponseClock[i].getHours() <= 23){
            dayPartsValues[2] += responseSpeed[i];
            dayPartsValuesCount[2]++;
          }else{
            if(ResponseClock[i].getMinutes() == 0){
              dayPartsValues[2] += responseSpeed[i];
              dayPartsValuesCount[2]++;
            } else{
              dayPartsValues[0] += responseSpeed[i];
              dayPartsValuesCount[0]++;
            }
          }
        }

        let exist =0;
        for(i =0; i<3;i++){
          if(dayPartsValuesCount[i] != 0){
              chartDataAvarageTime[exist] = dayPartsValues[i] / dayPartsValuesCount[i];
              chartDataAvarageTime[exist] = Math.round(chartDataAvarageTime[exist] * Math.pow(10, 2)) / Math.pow(10, 2);
              chartDataLabels[exist] = dayParts[i];
              exist++;
          }
        }

        weekDayChart.data.datasets[0].data = chartDataAvarageTime;
        weekDayChart.data.labels = chartDataLabels;
        weekDayChart.update();
        weekDayChart.resize();
      }

      //Create area chart
      var areaChart;
      // function chartIt(){
      // Get context with jQuery - using jQuery's .get() method.
      var areaChartCanvas = $('#areaChart').get(0).getContext('2d');
          
      var areaChartData = {
          labels  : ['margarīns,zupa'],
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
              data                : [1,2],
              fill: true,
              pointRadius: 4,
              pointHoverRadius: 6,
              pointBackgroundColor: 'white',
          },
          ]
      };
    
      var areaChartOptions = {
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
      areaChart = new Chart(areaChartCanvas, { 
          type: 'line',
          data: areaChartData, 
          options: areaChartOptions
      })

      setData();

      //Costomize and insert new data to charts and labels
      function insertData(newresponseTime){
        
        let speed = new Array();
        let clock = new Array();
        let clockForWeekChart = new Array();

        let friendlyNameCounter = 0;
        let checkCounter = 0;

        let minResponseTime = 3000000;
        let maxResponseTime = 0;
        let averageResponseTime = 0;

        while(newresponseTime[checkCounter]!=null){


            //round number to 4 numbers after ,
            speed[checkCounter] = Math.round((newresponseTime[checkCounter].value / 1000) * Math.pow(10, 2)) / Math.pow(10, 2);
            
            //find max response time
            if(maxResponseTime < speed[checkCounter]){
              maxResponseTime = speed[checkCounter];
            }

            //find min response time
            if(minResponseTime > speed[checkCounter]){
              minResponseTime = speed[checkCounter];
            }
          
            //Count together all response times
            averageResponseTime += speed[checkCounter];
            
            clock[checkCounter] = newresponseTime[checkCounter].clock;
            clock[checkCounter] = moment(clock[checkCounter]*1000).format("DD-MM-YYYY HH:mm:ss");

            clockForWeekChart[checkCounter] = newresponseTime[checkCounter].clock;
            
            checkCounter++;
        }

        //Work out average response time
        averageResponseTime /= checkCounter;
        averageResponseTime = Math.round(averageResponseTime * Math.pow(10, 2)) / Math.pow(10, 2);

        displayNewInfo(speed,checkCounter);
        $("#numberOfCheck").text(checkCounter);
        $('#minTime').text(minResponseTime + ' KBps');
        $('#averageTime').text(averageResponseTime + ' KBps');
        $('#maxTime').text(maxResponseTime + ' KBps');
        
        areaChart.data.datasets[0].data = speed;
        areaChart.data.labels = clock;
        areaChart.update();
        areaChart.resize();

        if(currentChartType == 0){
          insertDataToWeekdayChart(speed,clockForWeekChart);
        }else{
          insertDataToDayPartChart(speed,clockForWeekChart);
        }

      }

      let startHr = 0;
      let startMin = 0;

      let endHr = 15;
      let endMin = 0;

      function checkTime(history){
        let startHr = document.querySelectorAll('.hr')[0].value;
        let endHr = document.querySelectorAll('.hr')[1].value;
        let startMin = document.querySelectorAll('.min')[0].value;
        let endMin = document.querySelectorAll('.min')[1].value;

        let currentHr;
        let currentMin;
        let newHistory = {
          'histories' :{},
        };
        let i=0;
        for (const id in history['histories']) {
          currentHr = new Date(history['histories'][id]['clock']*1000).getHours();
          currentMin = new Date(history['histories'][id]['clock']*1000).getMinutes();
          if(currentHr > startHr && currentHr < endHr){
            newHistory['histories'][i] = history['histories'][id];
            i++
          }else if(currentHr == endHr && currentHr == startHr){
            if(currentMin >= startMin && currentMin <= endMin){
              newHistory['histories'][i] = history['histories'][id];
              i++
            }
          }else if(currentHr == startHr){
            if(currentMin >= startMin){
              newHistory['histories'][i] = history['histories'][id];
              i++
            }
          }else if(currentHr == endHr){
            if(currentMin <= endMin){
              newHistory['histories'][i] = history['histories'][id];
              i++
            }
          }
        }

        currentHistory = newHistory['histories'];
        return newHistory;
      }

      function callController(startDate,endDate,selectedItemId){

        if(selectedItemId != null){
          $.ajax( {
          type:'POST',
          header:{
          'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
          },
          url:"/user/monitoring/download-speed",
          data:{
          _token: "{{ csrf_token() }}",
          dataType: 'json', 
          contentType:'application/json', 
          item_id: selectedItemId,
          startDate: startDate,      
          endDate: endDate,
          }
          })
            .done(function(data) {
              //Costomize item hystory data
              newdata = checkTime(data);
              userDataCheck(newdata.histories,data.itemsFriendlyName,data.selectedId);
            })
            .fail(function() {
                alert(@json( __("error")));
            });
          }
      }

      //Insert new items to friendly name drop down form
      function addOptionsToDropDown(friendlyNames,dropDownValue){

          let dropDownCheckType = document.getElementById('userMonitors');
          let dropDownCheckTypeValue;

          if(dropDownValue){
              dropDownCheckTypeValue = dropDownValue;
          }

          let dropDownElements =document.getElementsByTagName('option');

          $("#userMonitors option").remove();

          //Add new items to user checks drop down form
          for (let x in friendlyNames) {
              newPersonItem =`
                              <option value='${x}'>${friendlyNames[x]['friendly_name']}</option>
                          `;
              const position = "beforeend";
              dropDownCheckType.insertAdjacentHTML(position,newPersonItem);
          }

          //Set Current check friendly name to dropDown
          $("#userMonitors").val(dropDownValue);
          
      }


      //Set value to daterangepicker
      let date = new Date().toLocaleDateString();
      $('input[name="datefilter"]').daterangepicker({
          autoUpdateInput: false,
          locale: {
              cancelLabel: 'Clear'
          },
          maxDate: date,
      });
      $('input[name="datefilter"]').on('apply.daterangepicker', function(ev, picker) {
          $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
      });

      $('input[name="datefilter"]').on('cancel.daterangepicker', function(ev, picker) {

      });

      $('#datePicker').on('apply.daterangepicker', function(ev, picker) {
        currentFriendlyNameSelected = $("#userMonitors option:checked").text();
        startDate = picker.startDate.format();
        startDate = Math.floor(Date.parse(startDate) / 1000);
        endDate = picker.endDate.format();
        if(picker.maxDate.format("YYYY-MM-DD hh:mm:ss A Z") == picker.endDate.format("YYYY-MM-DD hh:mm:ss A Z")){
          endDate = Math.floor(Date.parse(endDate) / 1000+(24*60*60-1));
        }else{
          endDate = Math.floor(Date.parse(endDate) / 1000);
        }

        //Get selected items id
        const selectedItemId = $("#userMonitors option:selected").val();
        
        callController(startDate,endDate,selectedItemId );

      });

      //EVENT LISTENERS
      
      $("#userMonitors").change(function(){
        //Get selected items id
        const selectedItemId = $("#userMonitors option:selected").val();
        
        callController(startDate,endDate,selectedItemId );
      });

      $('#timeButton').click(function() {
      let content = document.getElementById('timeSelectBox');

      if (content.style.height == '0px' || content.style.height == ''){
        content.style.height = 172 + 'px';
      } else {
        content.style.height = 0 + 'px';
      } 
    });

    $('#selectTime').click(function(){
        //Get selected items id
        const selectedItemId = $("#userMonitors option:selected").val();

        callController(startDate,endDate,selectedItemId );
    });

    $('#radioOption1').click(function(){
      currentChartType = 0;
      let value = new Array();
      let time = new Array();

      for (const property in currentHistory) {
        value[property] = Math.round((currentHistory[property]['value'] / 1000) * Math.pow(10, 2)) / Math.pow(10, 2);
        time[property] = currentHistory[property]['clock'];
      }

      insertDataToWeekdayChart(value,time);
    });

    $('#radioOption2').click(function(){
      currentChartType = 1;
      let value = new Array();
      let time = new Array();

      for (const property in currentHistory) {
        value[property] = Math.round((currentHistory[property]['value'] / 1000) * Math.pow(10, 2)) / Math.pow(10, 2);
        time[property] = currentHistory[property]['clock'];
      }
      insertDataToDayPartChart(value,time);
    });

    //Resize response time chart and change resize button icon
    $('#resize_btn').click(function(){
      var element = document.getElementById("responseChart");
      element.classList.toggle("col-md-12");
      var resizebtn = document.getElementById("resize_icon");
      resizebtn.classList.toggle("fa-expand-alt");
      resizebtn.classList.toggle("fa-compress-alt");
    });

      //TIME PICKERS
      const time_picker_element = document.querySelectorAll('.time-picker');
      
      const hr_element = document.querySelectorAll('.time-picker .hour .hr');
      const min_element = document.querySelectorAll('.time-picker .minute .min');

      const hr_up = document.querySelectorAll('.time-picker .hour .hr-up');
      const hr_down = document.querySelectorAll('.time-picker .hour .hr-down');

      const min_up = document.querySelectorAll('.time-picker .minute .min-up');
      const min_down = document.querySelectorAll('.time-picker .minute .min-down');

      let hour = [0,'23'];
      let minute = [0,59];

      //EVENT LISTENERS
      for(let i=0; i< time_picker_element.length;i++){

        hr_up[i].addEventListener('click', function(e){
          hour_up(i);
        });
        hr_down[i].addEventListener('click', function(e){
          hour_down(i);
        });

        min_up[i].addEventListener('click', function(e){
          minute_up(i);
        });
        min_down[i].addEventListener('click', function(e){
          minute_down(i);
        });

        hr_element[i].addEventListener('change', function(e){
          hour_change(e,i);
        });
        min_element[i].addEventListener('change', function(e){
          minute_change(e,i);
        });

      }

      function hour_change(e,data1){
        if(e.target.value > 23){
          e.target.value = 23;
        }else if(e.target.value < 0){
          e.target.value = '00';
        }

        if(e.target.value == ''){
          e.target.value = formatTime(hour[data1]);
        }

        hour[data1] = e.target.value;
      }

      function minute_change(e,data1){

        if(e.target.value > 59){
          e.target.value = 59;
        }else if(e.target.value < 0){
          e.target.value = '00';
        }

        if(e.target.value == ''){
          if(minute[data1] != '00'){
            e.target.value = formatTime(minute[data1]);
          }else{
            e.target.value = minute[data1];
          }
        }

        if(e.target.value == 0){
          e.target.value = '00';
        }

        minute[data1] = e.target.value;
      }

      function hour_up (data1){
        hour[data1]++;
        if(hour[data1] > 23) {
          hour[data1] = 0;
        }
        setTime(data1);
      }

      function hour_down (data1){
        hour[data1]--;
        if(hour[data1] < 0) {
          hour[data1] = 23;
        }
        setTime(data1);
      }

      function minute_up (data1){
        minute[data1]++;
        if(minute[data1] > 59) {
          minute[data1] = 0;
          if(hour[data1] == 23){
            hour[data1] = '0';
          }else{
            hour[data1]++;
          }
        }
        setTime(data1);
      }

      function minute_down (data1){
        minute[data1]--;
        if(minute[data1] < 0) {
          minute[data1] = 59;
          hour[data1]--;
          if( hour[data1] < 0){
            hour[data1]=23;
          }
        }
        setTime(data1);
      }

      function setTime(data1){
        hr_element[data1].value = formatTime(hour[data1]);
        min_element[data1].value = formatTime(minute[data1]);
        time_picker_element[data1].dataset.time = formatTime(hour[data1]) + ':' + formatTime(minute[data1]);
      }

      function formatTime(time){
        if( time < 10 && time != '00'){
          time = '0' + time;
        }

        return time;
      }
      
  });
</script>

@stop
