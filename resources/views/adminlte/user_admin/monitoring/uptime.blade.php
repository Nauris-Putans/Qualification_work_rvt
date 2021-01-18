@extends('adminlte::page')
@section('title', 'Uptime')

@section('content_header')
    <h1>Monitoring > Uptime</h1>
@stop

@section('content')
    <section class="upTimeMonitor">
        <div class="column">
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                      <label>Your monitor</label>
                      <select class="form-control" id='userMonitors'>
                  
                      </select>
                    </div>
                  </div>
                </div>
            </div>


            {{-- up time page info Boxes --}}
            <div class="row" id="upTimeInfoBoxes" >
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
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-cloud-upload-alt"></i></i></span>

                        <div class="info-box-content">
                        <span class="info-box-text">Uptime</span>
                        <span class="info-box-number" id="minTime">
                            {{-- up time in percent--}}
                        </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                <!-- /.info-box -->
                </div>
                <!-- /.col -->

            </div>
            {{--END up time page info Boxes --}}

            {{-- up time month statistic --}}
            <div class="row" id="upTimeChart">
                

                <div class="col-md-2">
                    <div class="monthLable">Decembris 2020</div>
                    <div class=" monthWrapper">
                        <div class="weekWrapper">
                            <div class="dayBox" >
                                <div class="content d-none">
                                    <div class="contentWrapper">
                                        <div class="contentWrapper_label">Monday 01</div>
                                        <div class="uptimeNumber"> 80 %</div>
                                        <button>More info</button>
                                    </div>
                                </div>
                            </div>
                            <div class="dayBox" >
                                <div class="content d-none">
                                    <button>bidzans</button>
                                </div>
                            </div>
                            <div class="dayBox" >
                                <div class="content d-none">
                                    <button>bidzans</button>
                                </div>
                            </div><div class="dayBox" >
                                <div class="content d-none">
                                    <button>bidzans</button>
                                </div>
                            </div><div class="dayBox" >
                                <div class="content d-none">
                                    <button>bidzans</button>
                                </div>
                            </div><div class="dayBox" >
                                <div class="content d-none">
                                    <button>bidzans</button>
                                </div>
                            </div><div class="dayBox" >
                                <div class="content d-none">
                                    <button>bidzans</button>
                                </div>
                            </div><div class="dayBox" >
                                <div class="content d-none">
                                    <button>bidzans</button>
                                </div>
                            </div>
                        </div>
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

        //Get values from controller MonitoringPageSpeedController
        //And send them to function insertData()        
        function setData(){
            let checkHistory = <?php echo json_encode($histories); ?>;
            let checkFriendlyName = <?php echo json_encode($itemsFriendlyName); ?>;

            if(checkFriendlyName != []){
                //Will be set as current value in drop down box
                let checkLastFriendlyName = checkFriendlyName[0];
                insertData(checkHistory,checkFriendlyName,checkLastFriendlyName);
            }
        }

        setData();

        //Check that user have any monitors and monitor value
        function userDataCheck(newresponseTime,newfriendlyNames,dropDownVal){

            if(newresponseTime.length === 0 || newresponseTime.length < 0){

           
            }else{

            insertData(newresponseTime,newfriendlyNames,dropDownVal);
            }
        }


        function addEventListenerToMonthChartBoxes(){
            var coll = document.getElementsByClassName("dayBox");
            var i;

            for (i = 0; i < coll.length; i++) {
                coll[i].addEventListener("mouseover", function() {
                    elementArray = document.getElementsByClassName("dayBox");
                    for (a = 0; a < elementArray.length; a++) {
                        if(elementArray[a].getElementsByClassName("content")[0].classList.toggle("d-none") === true){
                            
                        }else{
                            elementArray[a].getElementsByClassName("content")[0].classList.toggle("d-none");
                        }

                    }
                    this.getElementsByClassName("content")[0].classList.toggle("d-none");
                });

                coll[i].addEventListener("mouseleave", function() {
                    elementArray = document.getElementsByClassName("dayBox");
                    for (a = 0; a < elementArray.length; a++) {
                        if(elementArray[a].getElementsByClassName("content")[0].classList.toggle("d-none") === true){
                            
                        }else{
                            elementArray[a].getElementsByClassName("content")[0].classList.toggle("d-none");
                        }

                    }
                });
            }
        }

        function createMonthChart(uptimeHistoryData){

            // uptimeHistoryData[uptimeHistoryData.length-2]['clock'] = 1611579426;
            // uptimeHistoryData[uptimeHistoryData.length-1]['clock'] = 1614166201;
            let allDates = {};
            let allYearMonth = {};
            let allYearMonthID = 0;
            let oldFullDate = 0;
            let oldYearMonth = 0;
            let yearMonth;
            let newDate;
            let upTimeChart = document.getElementById("upTimeChart");

            //HTML construction
            let newMonthItem = '';

            let i=0,
                a=0;
                
            while(Object.keys(uptimeHistoryData).length > i){
                //Get date
                newDate = uptimeHistoryData[i]['clock'];
                newDate = new Date(newDate*1000);

                //Costumize date
                fullDate = (newDate.getDate()+' '+(newDate.getMonth()+1)+' '+newDate.getFullYear());
                
                if(fullDate != oldFullDate){

                    oldFullDate = fullDate;
                    allDates[a] = {};
                    allDates[a]['date'] = newDate;
                    allDates[a]['value'] = 0;
                    allDates[a]['valuesCounter'] = 0;

                    //Costumize date
                    yearMonth = newDate.getFullYear()+'_'+(newDate.getMonth()+1);
                    
                    if(yearMonth != oldYearMonth){

                        //Check new Month chart
                        newMonthItem =
                            `<div class="col-md-2" id="${yearMonth}">
                                <div class="monthLable">Decembris 2020</div>
                                <div class=" monthWrapper" id="monthWrapper_${yearMonth}">

                                </div>
                            </div>`;

                        const position = "beforeend";
                        upTimeChart.insertAdjacentHTML(position,newMonthItem);

                        oldYearMonth = yearMonth;
                        allYearMonth[allYearMonthID]={};
                        allYearMonth[allYearMonthID]['id'] = yearMonth;
                        allYearMonth[allYearMonthID]['date'] = newDate;
                        allYearMonthID++;
                    }

                    a++;
                }

                if(uptimeHistoryData[i]['value'] == '200' || uptimeHistoryData[i]['value'] == '1'){
                    allDates[a-1]['value'] ++;
                }
                allDates[a-1]['valuesCounter'] ++;

                i++;
            }




            let weekday = new Array(7);
                weekday[0] = "Sunday";
                weekday[1] = "Monday";
                weekday[2] = "Tuesday";
                weekday[3] = "Wednesday";
                weekday[4] = "Thursday";
                weekday[5] = "Friday";
                weekday[6] = "Saturday";
                
            let monthStartWeekDay;
            let monthLastDate;
            let monthWrapper;
            let weekWrapper;
            
            let c =0;
            while(Object.keys(allYearMonth).length > c){

                monthWrapper = allYearMonth[c]['id'];
                monthWrapper = document.getElementById("monthWrapper_"+monthWrapper);


                //first month date weekDay
                let firstMonthDay = allYearMonth[c]['date'];
                firstMonthDay.setMonth(firstMonthDay.getMonth(),1);
                firstMonthDay = firstMonthDay.getDay();

                //Last month date
                let monthLastDate = new Date(allYearMonth[c]['date'].getFullYear(), allYearMonth[c]['date'].getMonth() + 1, 0).getDate();

                let firstMonthDayCreated = false;
                let firstMonthDaysCouner = 0;
                let yearMonthWeek ;
                let sevenElements = 1;

                
                monthDate = 1;
                while(monthLastDate >= monthDate ){
                    
                    if(monthLastDate!=monthDate){
                        allYearMonth[c]['date'].setDate(monthDate+1);
                    }else{
                        allYearMonth[c]['date'].setDate(monthDate);
                    }

                    yearMonthWeek = allYearMonth[c]['date'].getFullYear()+'_'+(allYearMonth[c]['date'].getMonth()+1)+'_'+moment(allYearMonth[c]['date']).format('W');
                    weekWrapper = document.getElementById("weekWrapper_"+yearMonthWeek);

                    if(weekWrapper == null){
                        //Create new month item
                        let newWeekWrapper =
                            `<div class="weekWrapper" id="weekWrapper_${yearMonthWeek}">
                                
                            </div>`;

                        const position = "beforeend";
                        monthWrapper.insertAdjacentHTML(position,newWeekWrapper);
                        weekWrapper = document.getElementById("weekWrapper_"+yearMonthWeek);
                    }

                    //Find first date
                    if(firstMonthDayCreated === false){

                        if(weekday[firstMonthDay] == weekday[firstMonthDaysCouner]){
                            firstMonthDayCreated = true;
                        }else{
                            let newDayBox =
                                `<div class="dayBox" style="background-color:#f1f1f1;">
                                    <div class="content d-none">
                                        
                                    </div>
                                </div>`;

                            const position = "beforeend";
                            weekWrapper.insertAdjacentHTML(position,newDayBox);
                        }
                        firstMonthDaysCouner++;
                    }

                    if(firstMonthDayCreated === true){
                        let date = monthDate;
                        if(monthLastDate!=monthDate){
                            date = (allYearMonth[c]['date'].getDate())-1;
                        }
                       
                       let i=1;
                       let newDayBox =
                                `<div class="dayBox" style="background-color: #a0a0a0;" id="${date}" title="No Data" data-toggle="popover" data-trigger="hover" data-content="Data is not available">
                                    <div class="content d-none" >
                                       
                                    </div>
                                </div>`;
                                allDates[1]['value'] = 7;
                                allDates[5]['value'] = 13;
                       while((Object.keys(allDates).length) > i){
                            let color;
                            let math = (allDates[i]['value'] *100)/allDates[i]['valuesCounter'];
                            if(math>60){
                                color = 'green';
                            }else if(math<=60 && math>=50){
                                color = 'yellow';
                            }else{
                                color = 'red';
                            }

                           if(allDates[i]['date'].getDate() == date){
                            newDayBox =
                                `<div class="dayBox" style="background-color:${color};" id="${date}">
                                    <div class="content d-none">
                                        <div class="contentWrapper">
                                            <div class="contentWrapper_label">Monday 01</div>
                                            <div class="uptimeNumber"> 80 %</div>
                                            <button>More info</button>
                                        </div>
                                    </div>
                                </div>`;
                           }
                            i++;
                       }

                        const position = "beforeend";
                        weekWrapper.insertAdjacentHTML(position,newDayBox);
                        monthDate++;
                    }
                }

                c++;
            }

            console.log(allYearMonth);
            console.log(allDates);

            addEventListenerToMonthChartBoxes();

        }
 
        //Costomize and insert new data to charts and labels
        function insertData(newresponseTime,newfriendlyNames,dropDownVal){
            createMonthChart(newresponseTime);

            addOptionsToDropDown(newfriendlyNames,dropDownVal);
            $('[data-toggle="popover"]').popover(); 
        }

        //Insert new items to friendly name drop down form
        function addOptionsToDropDown(friendlyNames,dropDownValue){
            let dropDownUserMonitors = document.getElementById('userMonitors');
            let dropDownUserMonitorsValue;
            if(dropDownValue){
                dropDownUserMonitorsValue = dropDownValue.friendly_name;
            }else{
                dropDownUserMonitorsValue = $("#userMonitors").val();
            }
            let dropDownElements =document.getElementsByTagName('option');

            $("#userMonitors option").remove();

            //Add new items to user checks drop down form
            for (let x in friendlyNames) {
                newPersonItem =`
                                <option >${friendlyNames[x]['friendly_name']}</option>
                            `;
                const position = "beforeend";
                dropDownUserMonitors.insertAdjacentHTML(position,newPersonItem);
            }

            //Set Current check friendly name to dropDown
            $("#userMonitors").val(dropDownUserMonitorsValue);
            
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
          item_name: $('#userMonitors').val(),
          }


        })
          .done(function(data) {
              insertData(data.histories,data.itemsFriendlyName,null);
          })
          .fail(function() {
              alert("error");
          });
      }

    })
</script>

@stop
