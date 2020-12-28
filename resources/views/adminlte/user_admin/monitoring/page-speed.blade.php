@extends('adminlte::page')
@section('title', 'Page Speed')

@section('content_header')
    <h1>Monitoring > Page Speed</h1>
@stop

@section('content')

<section class="response-time">

    
    {{-- column start --}}
    <div class="column">

      {{-- Response time page settings --}}
      <div class="row">
        <div class="col-md-2">
          <div class="form-group">
            <label>Your check</label>
            <select class="form-control" id='checkType'>
        
            </select>
          </div>
        </div>
        <div class="col-md-3">
          <label>Date range</label>
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
      </div>

      {{-- Response time page info Boxes --}}
      <div class="row" id="responseTimeInfoBoxes" >
        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box">
            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Requests</span>
              <span class="info-box-number" id="requests">
                  {{-- Requests number --}}
              </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box mb-3">
            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-thumbs-up"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Min time</span>
              <span class="info-box-number" id="minTime">
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

        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box mb-3">
            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-wave-square"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Average time</span>
              <span class="info-box-number" id="averageTime">
                  {{-- Check average response time --}}
              </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box mb-3">
            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-down"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Max time</span>
              <span class="info-box-number" id="maxTime">
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
                <h3 class="card-title">Response time(ms)</h3>
                <a href="javascript:void(0);">View Report</a>
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
                <span class="text-muted">Last check's value change</span>
              </p>
            </div>
            <!-- /.d-flex -->

            <div class="position-relative mb-4"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
              <canvas id="areaChart" height="250" width="1128" class="chartjs-render-monitor" style="display: block; height: 200px; width: 903px;"></canvas>
            </div>

            </div>   
          </div>
        </div>

        {{-- Weekday average response time Start--}}
        <div class="col-md-4" id="weekdayChartBox">
          <div class="card" style = "height : 435px">
            <div class="card-header">
              <h3 class="card-title">Fixed Header Table</h3>

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

      <div class="row d-none" id="infoAlert">
        <div class="col-md-12">
          <div class="alert alert-info" style="margin: 0">
            <strong>Info!</strong> Indicates a neutral informative change or action.
          </div>
        </div>
      </div>
    </div>
    {{-- column end --}}
 


</section>


@stop

@section('css')
<link rel="stylesheet" href="/css/app.css">

@stop

@section('js')
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script src="{{ url('vendor/jquery.min.js') }}"></script>

{{--    <script src="node_modules/chart.js/dist/Chart.bundle.js"></script>--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js" charset="utf-8"></script>

<script>
  $(function () {   

    

      let friendlyNameCounter = 0;
      let checkCounter = 0;
      let endDate = new Date();
      let startDate = new Date(endDate);

      startDate.setDate(startDate.getDate() - 1);

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
                  <i ${lastCheckIcon} id="lastCheckIcon"></i>${Math.round(lastChecksDiference * Math.pow(10, 4)) / Math.pow(10, 4)}
                  `;
          const position = "beforeend";
          lastCheckValue.insertAdjacentHTML(position,newValue);
      } 

      //Resize response time chart and change resize button icon
      $('#resize_btn').click(function(){
          var element = document.getElementById("responseChart");
          element.classList.toggle("col-md-12");
          var resizebtn = document.getElementById("resize_icon");
          resizebtn.classList.toggle("fa-expand-alt");
          resizebtn.classList.toggle("fa-compress-alt");
      });

      //Check that user have any monitors and monitor value
      function userDataCheck(newresponseTime,newfriendlyNames,dropDownVal){
        let responseTimeInfoBoxes = document.getElementById("responseTimeInfoBoxes");
        let responseChart = document.getElementById("responseChart");
        let weekDayChartBox = document.getElementById("weekdayChartBox");
        let infoAlert = document.getElementById("infoAlert");

        if(newfriendlyNames.length === 0 ){

          if(responseTimeInfoBoxes.classList.toggle("d-none") === true){
            responseChart.classList.toggle("d-none");
            weekDayChartBox.classList.toggle("d-none");
            infoAlert.classList.toggle("d-none");
          }else{
            responseTimeInfoBoxes.classList.toggle("d-none");

          }
          // addOptionsToDropDown(newfriendlyNames,dropDownVal);
        }else{
          if(responseTimeInfoBoxes.classList.toggle("d-none") === true){
            responseTimeInfoBoxes.classList.toggle("d-none");
          }else{
            responseChart.classList.toggle("d-none");
            weekDayChartBox.classList.toggle("d-none");
            infoAlert.classList.toggle("d-none");
          }
          insertData(newresponseTime,newfriendlyNames,dropDownVal);
        }
      }


      //Get values from controller MonitoringPageSpeedController
      //And send them to function userDataCheck()
      function setData(){
          let checkHistory = <?php echo json_encode($histories); ?>;
          let checkFriendlyName = <?php echo json_encode($itemsFriendlyName); ?>;

          if(checkFriendlyName != []){
            //Will be set as current value in drop down box
            let checkLastFriendlyName = checkFriendlyName[0];
            userDataCheck(checkHistory,checkFriendlyName,checkLastFriendlyName);
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
          weekday[0] = "Sunday";
          weekday[1] = "Monday";
          weekday[2] = "Tuesday";
          weekday[3] = "Wednesday";
          weekday[4] = "Thursday";
          weekday[5] = "Friday";
          weekday[6] = "Saturday";

          let i=0;
          let b=0;
          let newDate;
          while(ResponseClock[i] != null){
            newDate = new Date(ResponseClock[i]*1000);
            b=0;
            for(b;b<7;b++){

              if(weekday[newDate.getDay()] == weekday[b]){
                weekdayCounter[b]++;
                weekdayResponseTimeSum[b] += responseSpeed[i];
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
              weekdayResponseTimeSum[a] = Math.round(weekdayResponseTimeSum[a] * Math.pow(10, 4)) / Math.pow(10, 4);
              chartDataLabels.push(weekday[a]);
              chartDataAvarageTime.push(weekdayResponseTimeSum[a]);
            }
          }  

          weekDayChart.data.datasets[0].data = chartDataAvarageTime;
          weekDayChart.data.labels = chartDataLabels;
          weekDayChart.update();
        }

      //Create area chart
      var areaChart;
      // function chartIt(){
        // Get context with jQuery - using jQuery's .get() method.
        var areaChartCanvas = $('#areaChart').get(0).getContext('2d');
            
        var areaChartData = {
            labels  : [],
            datasets: [
            {
                label               : 'Response time(ms)',
                backgroundColor     : 'rgba(60,141,188,0.2)',
                borderColor         : 'rgba(60,141,188,0.9)',
                pointRadius          : true,
                pointColor          : '#3b8bba',
                pointStrokeColor    : 'rgba(60,141,188,1)',
                pointHighlightFill  : '#fff',
                pointHighlightStroke: 'rgba(60,141,188,1)',
                data                : [],
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
        areaChart       = new Chart(areaChartCanvas, { 
            type: 'line',
            data: areaChartData, 
            options: areaChartOptions
        })
      // }

      if(<?php echo json_encode($histories); ?> != ''){
        //Will be something
      }

      setData();

      //Costomize and insert new data to charts and labels
      function insertData(newresponseTime,newfriendlyNames,dropDownVal){
        
        let speed = new Array();
        let clock = new Array();
        let clockForWeekChart = new Array();

        let friendlyNameCounter = 0
        let checkCounter = 0;

        let minResponseTime = 10;
        let maxResponseTime = 0;
        let averageResponseTime = 0;

        while(newresponseTime[checkCounter]!=null){


            //round number to 4 numbers after ,
            speed[checkCounter] = Math.round(newresponseTime[checkCounter].value * Math.pow(10, 4)) / Math.pow(10, 4);
            
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
            clock[checkCounter] = moment(clock[checkCounter]*1000).format("DD-MM-YYYY h:mm:ss");

            clockForWeekChart[checkCounter] = newresponseTime[checkCounter].clock;
            
            checkCounter++;
        }

        //Work out average response time
        averageResponseTime /= checkCounter;
        averageResponseTime = Math.round(averageResponseTime * Math.pow(10, 4)) / Math.pow(10, 4);

        displayNewInfo(speed,checkCounter);
        $("#numberOfCheck").text(checkCounter);
        $('#minTime').text(minResponseTime + 's');
        $('#averageTime').text(averageResponseTime + 's');
        $('#maxTime').text(maxResponseTime + 's');
        areaChart.data.datasets[0].data = speed;
        areaChart.data.labels = clock;
        areaChart.update();

        insertDataToWeekdayChart(speed,clockForWeekChart);
        addOptionsToDropDown(newfriendlyNames,dropDownVal);
      }

      function callController(startDate,endDate){
        $.ajax( {
          type:'POST',
          header:{
          'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
          },
          url:"/user/monitoring/page-speed",
          data:{
          _token: "{{ csrf_token() }}",
          dataType: 'json', 
          contentType:'application/json', 
          item_name: $('#checkType').val(),
          startDate: startDate,      
          endDate: endDate,
          }


        })
          .done(function(data) {
            userDataCheck(data.histories,data.itemsFriendlyName,null);
          })
          .fail(function() {
              alert("error");
          });
      }

      //Insert new items to friendly name drop down form
      function addOptionsToDropDown(friendlyNames,dropDownValue){
          let dropDownCheckType = document.getElementById('checkType');
          let dropDownCheckTypeValue;
          if(dropDownValue){
              dropDownCheckTypeValue = dropDownValue.friendly_name;
          }else{
              dropDownCheckTypeValue = $("#checkType").val();
          }
          let dropDownElements =document.getElementsByTagName('option');

          $("#checkType option").remove();

          //Add new items to user checks drop down form
          for (let x in friendlyNames) {
              newPersonItem =`
                              <option >${friendlyNames[x]['friendly_name']}</option>
                          `;
              const position = "beforeend";
              dropDownCheckType.insertAdjacentHTML(position,newPersonItem);
          }

          //Set Current check friendly name to dropDown
          $("#checkType").val(dropDownCheckTypeValue);
          
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
        startDate = picker.startDate.format();
        startDate = Math.floor(Date.parse(startDate) / 1000);
        endDate = picker.endDate.format();
        if(picker.maxDate.format("YYYY-MM-DD hh:mm:ss A Z") == picker.endDate.format("YYYY-MM-DD hh:mm:ss A Z")){
          endDate = Math.floor(Date.parse(endDate) / 1000+(24*60*60-1));
        }else{
          endDate = Math.floor(Date.parse(endDate) / 1000);
        }
        callController(startDate,endDate);

      });

      $("#checkType").change(function(){
        callController(startDate,endDate);
      });

      


  });
</script>
@stop
