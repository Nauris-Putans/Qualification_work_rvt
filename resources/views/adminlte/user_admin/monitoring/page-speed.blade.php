@extends('adminlte::page')
@section('title', __('Page Speed'))

@section('content_header')
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">
            <a href="{{ URL::route('admin.user_admin.index') }}" >{{ __('Dashboard')}}</a>
            \
            <a >{{ __('Response time')}}</a>
        </li>
    </ol>
</nav>
@stop

@section('content')

<section class="response-time">

  <div class="column">

    {{-- Settings forms --}}
    <div class="row">
      <div class="col-md-3">
        <label for="userMonitors">{{ __('Monitor') }}</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-desktop"></i></span>
          </div>
          <select class="form-control" id='userMonitors'>
      
          </select>
        </div>
      </div>
      {{-- Date settings --}}
      <div class="col-md-3">
        <label for="datePicker">{{ __('Date') }}</label>
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
        <label for="timeButton">{{ __('Time') }}</label>
        <div class="input-group">
          <button class="btn time-btn" id="timeButton" aria-label="Center Align">
            <i class="fas fa-clock" style="height: 100%; width: auto;"></i>
          </button>
          {{-- time settings container --}}
          <div class="time-content" id="timeSelectBox">
            <div class="select-time">
              <div class="time_picker_box">
                <div class="label">{{ __('Start time')}}</div>
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
                <div class="label">{{ __('End time')}}</div>
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


    {{-- Info Boxes --}}
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
        </div>
      </div>

      <div class="col-md-3">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-success elevation-1"><i class="fas fa-thumbs-up"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">{{ __('Min time') }}</span>
            <span class="info-box-number" id="minTime">
                {{-- Check min response time --}}
            </span>
          </div>
        </div>
      </div>


      <!-- fix for small devices only -->
      <div class="clearfix hidden-md-up"></div>

      <div class="col-md-3">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-wave-square"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">{{ __('Average time') }}</span>
            <span class="info-box-number" id="averageTime">

            </span>
          </div>
        </div>
      </div>

      <div class="col-md-3">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-down"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">{{ __('Max time') }}</span>
            <span class="info-box-number" id="maxTime">
                
            </span>
          </div>
        </div>
      </div>

    </div>

    {{-- Area chart --}}
    <div class="row">
      <div class="col-md-8" id="responseChart">
        <div class="card">
          <div class="card-header" style="background-color:white;">
            <div class="d-flex justify-content-between">
              <h3 class="card-title">{{ __('Response time(s)') }}</h3>
              <nav aria-label="pagination wrapper">
                <ul class="pagination" id="paginationWrapper">
                  
                </ul>
              </nav>
              <div class="card-tools d-flex" style="width: 65px; justify-content: space-between">
                {{-- Settings botton --}}
                <div class="tool">
                  <button type="button" id="areaChartSettingsBtn" class="btn btn-primary btn-sm daterange" data-toggle="tooltip" title="Date range">
                    <i class="fas fa-cog"></i>
                  </button>
                  <div class="areaChartSettingsContainer" id="areaChartSettingsWrapper">
                    <div class="settings-body">
                      <div class="form-group">
                        <label>Sort data</label>
                        <select class="form-control">
                          <option>Every point</option>
                          <option>Month days</option>
                          <option>Month</option>
                        </select>
                      </div>
                    </div>
                    <div class="settings-footer">
                      <div type="button" class="btn  bg-gradient-primary">Save</div>
                    </div>
                  </div>
                </div>

                {{-- Resize botton --}}
                <button type="button" name="resizeButton" class="btn btn-primary btn-sm daterange" id="resize_btn" aria-label="Center Align">
                  <i id="resize_icon" class="fas fa-expand-alt"></i>
                </button>
              </div>
            </div>
          </div>

          <div class="card-body" id="areaChartBody">
            <div class="d-flex">
              <p class="ml-auto d-flex flex-column text-right">
                <span id="lastCheckValue">
                  <i ${lastCheckIcon} id="lastCheckIcon"></i>
                </span>
                <span class="text-muted">{{ __("Last check's value change") }}</span>
              </p>
            </div>
            <!-- /.d-flex -->

            <div class="position-relative mb-4">
              <canvas id="areaChart" height="257" width="1128" class="chartjs-render-monitor" style="display: block; min-height: 257px; width: 903px;"></canvas>
            </div>
          </div>
          <div class="card-body card-body-default" id="areaChartDefaultBody">
            No data available
          </div>
        </div>
      </div>

      {{-- Bar chart--}}
      <div class="col-md-4" id="weekdayChartBox">
        <div class="card">
          {{-- Card header --}}
          <div class="card-header ui-sortable-handle" style="cursor: move;">
            <h3 class="card-title" id="barChartTitle">
              <i class="fas fa-calendar-alt"></i>
              Week days
            </h3>
            <!-- card tools -->
            <div class="card-tools">
              <button type="button" class="btn btn-primary btn-sm daterange" data-toggle="tooltip" title="Date range">
                <i class="fas fa-sliders-h"></i>
              </button>
            </div>

          </div>

          <div class="card-header border-0 card-header-center" id="barChartSliderBody">
            <div class="slidecontainer">
              <input type="range" min="1" max="2" value="1" class="slider" id="barChartRang">
            </div>
          </div>

          <div class="card-body  table-responsive p-0" style = "height : 337px" id="weekDayChartBody" >
            <canvas id="weekDayChart" height="100%" width="100%" class="chartjs-render-monitor" style="display: block; max-height: 100%; max-width: 100%;"></canvas>
          </div>
          <div class="card-body card-body-default" id="barChartDefaultBody">
            No data available
          </div>

        </div>
        <!-- /.card -->
      </div>
      {{-- Weekday average response time END--}}
    </div>
 
</section>


@stop

@section('css')
<link rel="stylesheet" href="/css/app.css">
<link href="/css/adminlte/user_admin/statistic.css" rel="stylesheet">

{{-- Data picker styles --}}
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@stop

@section('js')
{{-- Data picker js --}}
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

{{-- Chart js--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js" charset="utf-8"></script>

<script>
  $(function () {  

    const slider = document.getElementById("barChartRang");

    slider.oninput = function() {

      $("#barChartTitle").empty();

      if(this.value == 1) {
        currentChartType = 0;
        let value = new Array();
        let time = new Array();

        let i = 0;
        for (const property in splitedHystory[sortedHistoryIndex-1]) {
          value[i] = Math.round(currentHistory[property]['value'] * Math.pow(10, 4)) / Math.pow(10, 4);
          time[i] = currentHistory[property]['clock'];
          i++;
        }
      
        insertDataToWeekdayChart(value,time);

        const newTitle = `
          <i class="fas fa-calendar-alt"></i>
          Week days
        `
        $("#barChartTitle").append(newTitle);
      }else {
        currentChartType = 1;
        let value = new Array();
        let time = new Array();

        let i=0;
        for (const property in splitedHystory[sortedHistoryIndex-1]) {
          value[i] = Math.round(currentHistory[property]['value'] * Math.pow(10, 4)) / Math.pow(10, 4);
          time[i] = currentHistory[property]['clock'];
          i++;
        }
        insertDataToDayPartChart(value,time);

        const newTitle = `
          <i class="fas fa-clock"></i>
          Day part
        `
        $("#barChartTitle").append(newTitle);
      }

    }

    let endDate = new Date();
    let startDate = new Date(endDate);
    let currentHistory;
    let currentChartType = 0;
    let splitedHystory = [];
    let sortedHistoryIndex = 0;
    let startHr = 0;
    let startMin = 0;
    let endHr = 15;
    let endMin = 0;
    let selectedMonitorId;

    const weekday = new Array(7);
        weekday[0] = @json( __("Sunday")  );
        weekday[1] = @json( __("Monday")  );
        weekday[2] = @json( __("Tuesday")  );
        weekday[3] = @json( __("Wednesday")  );
        weekday[4] = @json( __("Thursday")  );
        weekday[5] = @json( __("Friday")  );
        weekday[6] = @json( __("Saturday")  );

    const dayParts = new Array(3);
      dayParts[0] = @json( __('Morning')  );
      dayParts[1] = @json( __('Afternoon')  );
      dayParts[2] = @json( __('Evening')  );

    startDate.setDate(startDate.getDate() - 1);
    startDate.setHours(0);
    startDate.setMinutes(0);
    endDate.toDateString();
    startDate.toDateString();

    //Function that display new info to info label
    function displayNewInfo(responseSpeedMS,checkCount){
        OldLastCheckValue = document.getElementById('lastCheckIcon');

        OldLastCheckValue.remove();
        $("#lastCheckValue").text('');

        lastCheckValue = document.getElementById('lastCheckValue');
        lastChecksDiference = Math.round((responseSpeedMS[checkCount-1] - responseSpeedMS[checkCount-2]) * Math.pow(10, 4)) / Math.pow(10, 4);
        let lastCheckIcon ;
        if(lastChecksDiference<0){
            lastCheckIcon ='class="fas fa-arrow-down" style="margin-right: 5px"';
            $('#lastCheckValue').css('color','green');
        }else if(lastChecksDiference>0)
        {
            lastCheckIcon ='class="fas fa-arrow-up" style="margin-right: 5px"';
            $('#lastCheckValue').css('color','red');
        }else{
          $('#lastCheckValue').css('color','orange');
        }
    
        let newValue =`
                <i ${lastCheckIcon} id="lastCheckIcon"></i>${lastChecksDiference}
                `;
        const position = "beforeend";
        lastCheckValue.insertAdjacentHTML(position,newValue);
    } 

    function disableMainSettings(){
      $('#userMonitors').attr('disabled', 'disabled');
      $('#datePicker').attr('disabled', 'disabled');
      $('#timeButton').attr('disabled', 'disabled');
    }

    function enableMainSettings(){
      $('#userMonitors').removeAttr('disabled');
      $('#datePicker').removeAttr('disabled');
      $('#timeButton').removeAttr('disabled');
    }

    function friendlyNameCheck(newFriendlyNames){
      let monitorCount = newFriendlyNames.length;

      if(monitorCount === 0) {
        disableMainSettings();
      }else {
        enableMainSettings();
        if(selectedMonitorId != null){
          addOptionsToDropDown(newFriendlyNames,selectedMonitorId);
        }else{
          const firstMonitor = Object.keys(newFriendlyNames)[0];
          addOptionsToDropDown(newFriendlyNames,firstMonitor);
        }
      }

    }

    function historyCountCheck(newHistoryValues, minCheckCount){
      let permission;

      if(Object.keys(newHistoryValues).length < minCheckCount) {
        permission = 0;
      }else {
        permission = 1;
      }

      return permission;
    }

    function showAreaChart(){
      $('#areaChartBody').css('display','block');
      $("#areaChartDefaultBody").css( "display", "none" );
    }

    function hideAreaChart(){
      $('#areaChartBody').css('display','none');
      $("#areaChartDefaultBody").css( "display", "block" );
    }

    function showBarChart(){
      $('#weekDayChartBody').css('display','block');
      $('#barChartSliderBody').css('display','flex');
      $("#barChartDefaultBody").css( "display", "none" );
    }

    function hideBarChart(){
      $('#weekDayChartBody').css('display','none');
      $('#barChartSliderBody').css('display','none');
      $("#barChartDefaultBody").css( "display", "block" );
    }

    //Check that user have any monitors and monitor value
    function dataCheck(newresponseTime,newfriendlyNames,dropDownVal){

      const responseTimeInfoBoxes = document.getElementById("responseTimeInfoBoxes");
      const responseChart = document.getElementById("responseChart");
      const weekDayChartBox = document.getElementById("weekdayChartBox");

      friendlyNameCheck(newfriendlyNames);


      const enoughData = historyCountCheck(newresponseTime,2);

      if(enoughData){
        const newHystoryData = spliteHistory();
        insertData(newHystoryData);
        showAreaChart();
        showBarChart();
      }else{
        insertNewValueIntoInfoBoxes(0, 0, 0, 0);
        hideAreaChart();
        hideBarChart();
      }     
    }

    function paginationButtons(paginationCount){
      $('#paginationWrapper li').remove();

      sortedHistoryIndex = paginationCount;
      let buttonStatus = '';
      let paginationList = '';

      if(paginationCount <= 1){
        buttonStatus = 'disabled'
      }

      for(let i=1; i<=paginationCount;i++ ){ 
        if(paginationCount == i){
          paginationList += `<li class="page-item cursor-pointer no-copy active"><a id="pagination${i}" class="page-link">${i}</a></li>`
        }else{
          paginationList += `<li class="page-item cursor-pointer no-copy"><a id="pagination${i}" class="page-link">${i}</a></li>`;
        }
      }

      $( "#paginationWrapper" ).append( `
          <li class="page-item cursor-pointer no-copy ${buttonStatus}" id="previosPagination1">
            <a id="previosPagination" class="page-link page-link-left" aria-label="Previous">
              <span aria-hidden="true">&laquo;</span>
            </a>
          </li>
          ${paginationList}
          <li class="page-item cursor-pointer no-copy disabled">
            <a id="nextPagination" class="page-link page-link-right"  aria-label="Next">
              <span aria-hidden="true">&raquo;</span>
            </a>
          </li>
      `);

      for(let i=1; i<=paginationCount ; i++){
        if(i+4 < paginationCount){
          $( `#pagination${i}` ).parent().addClass('d-none');
        }
      }

      //Add event listener to paginations
      const allPaginations =  $( "#paginationWrapper").children();
      const paginationLength = allPaginations.length;
      for(let i=0;i<paginationLength;i++){

        const paginationId = allPaginations[i].children[0].id;

        switch(paginationId) {
          case 'previosPagination':
            $("#previosPagination").click( function(){

              $('#paginationWrapper li').not( "#previosPagination" ).addClass('d-none');
              $('#nextPagination').parent().removeClass('d-none')
              $('#previosPagination').parent().removeClass('d-none')

              sortedHistoryIndex--;

              let lastElementDisplay = sortedHistoryIndex+2;
              let firstElementDisplay = sortedHistoryIndex-2;

              if(lastElementDisplay >= paginationCount){
                firstElementDisplay = firstElementDisplay - (lastElementDisplay - paginationCount);
                lastElementDisplay = paginationCount;
              }else{
                if(firstElementDisplay < 1){
                  firstElementDisplay = 1;
                  lastElementDisplay = 5;
                }
              }

              for(let i=1 ;i <= paginationCount; i++){
                if(i >= firstElementDisplay && i <= lastElementDisplay){
                  if(i > 0 && i <= paginationCount){
                    $( `#pagination${i}`).parent().removeClass('d-none');
                  }
                }
              }

              if(1 == sortedHistoryIndex){
                $( "#previosPagination").parent().addClass('disabled');
                if(paginationCount > 1){
                  $( "#nextPagination").parent().removeClass('disabled');
                }

                $( `#pagination${sortedHistoryIndex+1}`).parent().removeClass('active');
                $( `#pagination${sortedHistoryIndex}`).parent().addClass('active');
                insertData(splitedHystory[sortedHistoryIndex-1]);
              }else if(1 < sortedHistoryIndex){
                $( "#previosPagination").parent().removeClass('disabled');
                if(paginationCount > 1){
                  $( "#nextPagination").parent().removeClass('disabled');
                }

                $( `#pagination${sortedHistoryIndex+1}`).parent().removeClass('active');
                $( `#pagination${sortedHistoryIndex}`).parent().addClass('active');
                insertData(splitedHystory[sortedHistoryIndex-1]);
              }
            });
            break;
          case 'nextPagination':
            $(`#${paginationId}`).click( function(){

              $('#paginationWrapper li').not( "#previosPagination" ).addClass('d-none');
              $('#nextPagination').parent().removeClass('d-none')
              $('#previosPagination').parent().removeClass('d-none')

              sortedHistoryIndex++;

              let lastElementDisplay = sortedHistoryIndex+2;
              let firstElementDisplay = sortedHistoryIndex-2;

              if(lastElementDisplay >= paginationCount){
                firstElementDisplay = firstElementDisplay - (lastElementDisplay - paginationCount);
                lastElementDisplay = paginationCount;
              }else{
                if(firstElementDisplay < 1){
                  firstElementDisplay = 1;
                  lastElementDisplay = 5;
                }
              }

              for(let i=1 ;i <= paginationCount; i++){
                if(i >= firstElementDisplay && i <= lastElementDisplay){
                  if(i > 0 && i <= paginationCount){
                    $( `#pagination${i}`).parent().removeClass('d-none');
                  }
                }
              }

              if(paginationCount == sortedHistoryIndex){
                $( "#nextPagination").parent().addClass('disabled');
                if(paginationCount > 1){
                  $( "#previosPagination").parent().removeClass('disabled');
                }
                
                $( `#pagination${sortedHistoryIndex-1}`).parent().removeClass('active');
                $( `#pagination${sortedHistoryIndex}`).parent().addClass('active');
                insertData(splitedHystory[sortedHistoryIndex-1]);
              }else if(paginationCount > sortedHistoryIndex){
                $( "#nextPagination").parent().removeClass('disabled');
                if(paginationCount > 1){
                  $( "#previosPagination").parent().removeClass('disabled');
                }
                
                $( `#pagination${sortedHistoryIndex-1}`).parent().removeClass('active');
                $( `#pagination${sortedHistoryIndex}`).parent().addClass('active');
                insertData(splitedHystory[sortedHistoryIndex-1]);
              }
            });
            break;
          default:
            $(`#${paginationId}`).click( function(){
              sortedHistoryIndex = parseInt(paginationId.replace("pagination", ""));
              if(paginationCount == sortedHistoryIndex){
                $( "#nextPagination").parent().addClass('disabled');
              }else{
                $( "#nextPagination").parent().removeClass('disabled');
              }

              if(1 == sortedHistoryIndex){
                $( "#previosPagination").parent().addClass('disabled');
              }else{
                $( "#previosPagination").parent().removeClass('disabled');
              }

              $( "#paginationWrapper").children().removeClass('active');
              insertData(splitedHystory[sortedHistoryIndex-1]);
              $( `#${paginationId}`).parent().addClass('active');
            });
        }
      }
    }

    function spliteHistory(){
      let historyElementCount = Object.keys(currentHistory).length;
      const paginationCount = Math.ceil(historyElementCount/500);

      let splitStart = historyElementCount-1;
      let splitEnd = historyElementCount - 500;

      for(let i=paginationCount-1 ;i >= 0; i--){

        if(splitEnd < 0){
          splitEnd = 0;
        }

        splitedHystory[i] = [];

        for(splitStart ;splitStart >= splitEnd; splitStart--){

          splitedHystory[i][splitStart] = {};
          splitedHystory[i][splitStart].itemid = currentHistory[splitStart].itemid;
          splitedHystory[i][splitStart].clock = currentHistory[splitStart].clock;
          splitedHystory[i][splitStart].value = currentHistory[splitStart].value;
        }
        splitEnd -=  500;
      }

      paginationButtons(paginationCount);

      let displayHystory = 0;

      return splitedHystory[paginationCount-1];
    }

    function getStart(){
        let checkHistory = <?php echo json_encode($histories); ?>;
        let checkFriendlyName = <?php echo json_encode($itemsFriendlyName); ?>;
        const checkItemsIds = <?php echo json_encode($itemsIds); ?>;

        $('#datePicker').daterangepicker({ startDate:  startDate, endDate: endDate });

        startDate = Math.floor(Date.parse(startDate) / 1000);
        endDate = Math.floor(Date.parse(endDate) / 1000);

        currentHistory = checkHistory;

        const allValues = getOnlyValues(currentHistory);
        updateInfoBoxes(allValues);

        if(Object.keys(checkFriendlyName).length != 0){
          const checkLastFriendlyName = checkItemsIds[0].item_id;
          dataCheck(checkHistory,checkFriendlyName,checkLastFriendlyName);
        }else{
          dataCheck(checkHistory,[],[]);
        }
    }


var radiusPlus = 4;
Chart.elements.Rectangle.prototype.draw = function() {
   var ctx = this._chart.ctx;
   var vm = this._view;
   var left, right, top, bottom, signX, signY, borderSkipped;
   var borderWidth = vm.borderWidth;

   if (!vm.horizontal) {
       left = vm.x - vm.width / 2;
       right = vm.x + vm.width / 2;
       top = vm.y;
       bottom = vm.base;
       signX = 1;
       signY = bottom > top? 1: -1;
       borderSkipped = vm.borderSkipped || 'bottom';
   } else {
       left = vm.base;
       right = vm.x;
       top = vm.y - vm.height / 2;
       bottom = vm.y + vm.height / 2;
       signX = right > left? 1: -1;
       signY = 1;
       borderSkipped = vm.borderSkipped || 'left';
   }

   if (borderWidth) {
   var barSize = Math.min(Math.abs(left - right), Math.abs(top - bottom));
   borderWidth = borderWidth > barSize? barSize: borderWidth;
   var halfStroke = borderWidth / 2;
   var borderLeft = left + (borderSkipped !== 'left'? halfStroke * signX: 0);
   var borderRight = right + (borderSkipped !== 'right'? -halfStroke * signX: 0);
   var borderTop = top + (borderSkipped !== 'top'? halfStroke * signY: 0);
   var borderBottom = bottom + (borderSkipped !== 'bottom'? -halfStroke * signY: 0);

   if (borderLeft !== borderRight) {
       top = borderTop;
       bottom = borderBottom;
   }
   if (borderTop !== borderBottom) {
       left = borderLeft;
       right = borderRight;
   }
   }

   var barWidth = Math.abs(left - right);
   var roundness = this._chart.config.options.barRoundness || 0.5;
   var radius = barWidth * roundness * 0.5;
   
   var prevTop = top;
   
   top = prevTop + radius;
   var barRadius = top - prevTop;

   ctx.beginPath();
   ctx.fillStyle = vm.backgroundColor;
   ctx.strokeStyle = vm.borderColor;
   ctx.lineWidth = borderWidth;

   // draw the chart
   var x= left, y = (top - barRadius + 1), width = barWidth, height = bottom - prevTop, radius = barRadius + radiusPlus;

   ctx.moveTo(x + radius, y);
   ctx.lineTo(x + width - radius, y);
   ctx.quadraticCurveTo(x + width, y, x + width, y + radius);
   ctx.lineTo(x + width, y + height);
   ctx.lineTo(x, y + height);
   ctx.lineTo(x, y + radius);
   ctx.quadraticCurveTo(x, y, x + radius, y);
   ctx.closePath();

   ctx.fill();
   if (borderWidth) {
   ctx.stroke();
   }

   top = prevTop;
}

function getBarChartBackgroundColors(ctx){
  let background_1 = ctx.createLinearGradient(0, 0, 0, 600);
    background_1.addColorStop(0, 'red');
    background_1.addColorStop(1, 'blue');

  let background_2 = ctx.createLinearGradient(0, 0, 0, 600);
    background_2.addColorStop(0, 'yellow');
    background_2.addColorStop(1, 'red');

  let background_3 = ctx.createLinearGradient(0, 0, 0, 600);
    background_3.addColorStop(0, 'green');
    background_3.addColorStop(1, 'yellow');

  let background_4 = ctx.createLinearGradient(0, 0, 0, 600);
    background_4.addColorStop(0, '#783c78');
    background_4.addColorStop(1, '#783cb4');

  let background_5 = ctx.createLinearGradient(0, 0, 0, 600);
    background_5.addColorStop(0, '#783c78');
    background_5.addColorStop(1, '#f0003c');

  let background_6 = ctx.createLinearGradient(0, 0, 0, 600);
    background_6.addColorStop(0, '#00b4f0');
    background_6.addColorStop(1, '#f0b4f0');

  let background_7 = ctx.createLinearGradient(0, 0, 0, 600);
    background_7.addColorStop(0, 'green');
    background_7.addColorStop(1, 'yellow');

  const background = [
    background_1,
    background_2,
    background_3,
    background_4,
    background_5,
    background_6,
    background_7
  ]
    return background;
}

//Create barChart 
let weekDayChart;
  let barChartCanvas = $('#weekDayChart').get(0).getContext('2d');
  let backgroundColors = getBarChartBackgroundColors(barChartCanvas);
  let  weekDayChartData        = {
    labels: [
        'Default',
    ],
    datasets: [
      {
        data: [1],
        backgroundColor : backgroundColors,
      }
    ]
  }
  let weekDayChartOptions = {
    legend: {
      display: false
    },
    animation: {
      animateScale: true,
    },
    scales: {
      xAxes: [{
        barThickness: 60,
        gridLines : {
          display : false,
        }
      }],
      yAxes: [{
        gridLines : {
          display : true,
        },
        ticks: {
          beginAtZero: true,// minimum value will be 0.
        }
      }]
    },
    maintainAspectRatio : false,
    animation: {
      duration: 1000 // general animation time
    },
    hover: {
        animationDuration: 0 // duration of animations when hovering an item
    },
    layout: {
      padding: {
          left: 30,
          right: 40,
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
    weekDayChart.resize();
  }

  function insertDataToDayPartChart(responseSpeed,ResponseClock){

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
          chartDataAvarageTime[exist] = Math.round(chartDataAvarageTime[exist] * Math.pow(10, 4)) / Math.pow(10, 4);
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
  let areaChart;

  // Get context with jQuery - using jQuery's .get() method.
  let areaChartCanvas = $('#areaChart').get(0).getContext('2d');

  let gradientStroke = areaChartCanvas.createLinearGradient(0,200,10, 0,100,20);
      gradientStroke.addColorStop(0, "rgba(60,141,188,0.9)");
      gradientStroke.addColorStop(1, "rgba(60,141,188,0.2)");


  var areaChartData = {
      labels  : [],
      datasets: [
      {
          label               : 'Response time(s)',
          backgroundColor     : gradientStroke,
          borderColor         : 'rgba(60,141,188,0.9)',
          pointRadius          : true,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [],
          fill: true,
          pointRadius: 2,
          pointHoverRadius: 3,
          pointBackgroundColor: 'white',
      },
      ]
  };

  var areaChartOptions = {
      maintainAspectRatio : false,
      animation: false,
      // animation: {
      //   easing: "easeInSine"
      // },
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

  getStart();

  function setMaxValue(newValue){
    let maxResponseTime = 0;

    let i=0;

    for( const value in newValue){

      if(maxResponseTime < parseFloat(newValue[value])){
        maxResponseTime = parseFloat(newValue[value]);
      }

      i++;
    }

    return roundNumber(maxResponseTime,4);
  }

  function setMinValue(newValue){
    let minResponseTime = 10;

    let i=0;

    for( const value in newValue){

      if(minResponseTime > parseFloat(newValue[value]) ){
        minResponseTime = parseFloat(newValue[value]);
      }

      i++;
    }

    return roundNumber(minResponseTime,4);
  }

  function setAverageValue(newValue){

    let averageResponseTime = 0;

    let i=0;

    for( const value in newValue){
      averageResponseTime += parseFloat(newValue[value])
      i++;
    }

    averageResponseTime /= i;

    return roundNumber(averageResponseTime,4);
  }

  function roundNumbers(newData,numbersDecimalPlaces){
    let time = new Array();

    let i=0;
    for( const value in newData){
      time[i] = Math.round(newData[value].value * Math.pow(10, numbersDecimalPlaces)) / Math.pow(10, numbersDecimalPlaces);
      i++;
    }

    return time;
  }

  function roundNumber(number,numbersDecimalPlaces){

    let roundedNumber = Math.round(number * Math.pow(10, numbersDecimalPlaces)) / Math.pow(10, numbersDecimalPlaces);

    return roundedNumber;
  }

  function customizeDateAllPoints(newData){
    let clock = new Array();
    let clockForWeekChart = new Array();

    let i=0;
    for( const value in newData){
      
      clock[i] = newData[value].clock;

      // clock[i] = moment(clock[i]*1000).format("DD MMMM");
      clock[i] = moment(clock[i]*1000).format("MM-DD HH:mm");
      clockForWeekChart[i] = newData[value].clock;

      i++;
    }

    return clock;
  }

  function customizeDataMonth(newData){

    let customizeHystory = {
      clock: [],
      value: []
    };

    let elementCounter = [];

    let i = -1;
    let currentDate = 0;
    for (const [key, value] of Object.entries(newData)) {
      const stringDate = moment(value.clock*1000).format("YYYY-MM-DD");
 
      if(stringDate == currentDate){
        elementCounter[i] ++;
        customizeHystory.value[i] += parseFloat(value.value);
      }else{
        i++;
        elementCounter[i] = 1;
        customizeHystory.clock[i] = stringDate;
        customizeHystory.value[i] = parseFloat(value.value);
        currentDate = stringDate;
      };

    }

    i=0;
    for (const [key, value] of Object.entries(customizeHystory.value)) {
      customizeHystory.value[key] /= elementCounter[key];
      customizeHystory.value[key] = roundNumber(customizeHystory.value[key], 4);
      i++;
    }
console.log(customizeHystory);
// console.log(elementCounter);
    return customizeHystory;
  }

  function customizeDateForBarChart(newData){
    let clockForWeekChart = new Array();

    let i=0;
    for( const value in newData){
      clockForWeekChart[i] = newData[value].clock;
      i++;
    }

    return clockForWeekChart;
  }


  function updateBarChart(newValue, newClock){
    if(currentChartType == 0){
      insertDataToWeekdayChart(newValue,newClock);
    }else{
      insertDataToDayPartChart(newValue,newClock);
    }
  }

  function updateAreaChart(values, labels){
    areaChart.data.datasets[0].data = values;
    areaChart.data.labels = labels;
    areaChart.update();
    areaChart.resize();
  }

  function getCheckCount(newData){
    let checkCounter = 0;
    for( const value in newData){     
        checkCounter++;
    }

    return checkCounter;
  }

  function updateInfoBoxes(newData){
    const checkCount = getCheckCount(newData);
    const averageTime = setAverageValue(newData);
    const minTime = setMinValue(newData);
    const maxTime = setMaxValue(newData);

    insertNewValueIntoInfoBoxes(checkCount, averageTime, minTime, maxTime);
  }

  function insertNewValueIntoInfoBoxes(checkCount, averageTime, minTime, maxTime){
    $('#averageTime').text(averageTime + 's');
    $('#maxTime').text(maxTime + 's');
    $('#minTime').text(minTime + 's');
    $("#requests").text(checkCount);
  }

  function getOnlyValues(newData){

    let values = [];
    let i=0;
    for (const [key, data] of Object.entries(newData)) {
      values[i] = data.value;
      i++;
    }

    return values;
  }

  function insertData(newData){

    const checkCount = getCheckCount(newData);
    const value = roundNumbers(newData,4);
    const clock = customizeDateAllPoints(newData);
    const clockForBarChart = customizeDateForBarChart(newData);

    customizeDataMonth(newData);

    displayNewInfo(value,checkCount);
    updateAreaChart(value, clock);
    updateBarChart(value,clockForBarChart);
  }

  function matchDataWithTimeInterval(history){
    startHr = document.querySelectorAll('.hr')[0].value;
    endHr = document.querySelectorAll('.hr')[1].value;
    startMin = document.querySelectorAll('.min')[0].value;
    endMin = document.querySelectorAll('.min')[1].value;

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
        item_id: selectedMonitorId,
        startDate: startDate,      
        endDate: endDate,
        }


      })
        .done(function(data) {
          newdata = matchDataWithTimeInterval(data);

          const allValues = getOnlyValues(newdata.histories);
          updateInfoBoxes(allValues);

          dataCheck(newdata.histories,data.itemsFriendlyName,data.selectedId);
        })
        .fail(function() {
            alert("error");
        });
  }

  //Insert new items to friendly name drop down form
  function addOptionsToDropDown(friendlyNames,dropDownValue){
    let dropDownCheckType = document.getElementById('userMonitors');

    let dropDownElements =document.getElementsByTagName('option');

    $("#userMonitors option").remove();

    for (let x in friendlyNames) {
        newMonitors =`
                        <option value='${x}'>${friendlyNames[x]['friendly_name']}</option>
                    `;
        const position = "beforeend";
        dropDownCheckType.insertAdjacentHTML(position,newMonitors);
    }

    selectedMonitorId = dropDownValue;
    $("#userMonitors").val(dropDownValue);
  }


  //Set value to daterangepicker
  let maxdate = new Date().toLocaleDateString();
  $('input[name="datefilter"]').daterangepicker({
      autoUpdateInput: false,
      locale: {
          cancelLabel: 'Clear'
      },
      maxDate: maxdate,
  });

  $('input[name="datefilter"]').on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
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

  //EVENT LISTENERS

  $('#areaChartSettingsBtn').click(function(e){
    $('#areaChartSettingsWrapper').toggle('d-none');
  });
  
  $("#userMonitors").change(function(){
    selectedMonitorId = $("#userMonitors option:selected").val();
    callController(startDate,endDate);
  });

  $('#timeButton').click(function() {
    hideOrShowSelectTimeBox();
  });

function hideOrShowSelectTimeBox(){
  let content = document.getElementById('timeSelectBox');

  if (content.style.height == '0px' || content.style.height == ''){
    content.style.height = 172 + 'px';
  } else {
    content.style.height = 0 + 'px';
  } 
}

$('#selectTime').click(function(){
    hideOrShowSelectTimeBox();

    const selectedDropDownOption = $("#userMonitors option:selected").val();

    callController(startDate,endDate,selectedDropDownOption);
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
    if( time < 10){
      time = '0' + time;
    }

    return time;
  }

});
</script>
@stop
