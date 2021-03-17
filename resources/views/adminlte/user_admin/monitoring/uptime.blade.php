@extends('adminlte::page')
@section('title', 'Uptime')

@section('content_header')
    <h1>{{ __('Monitoring')}} > {{ __('Uptime')}}</h1>
@stop

@section('content')
    <section class="upTimeMonitor">
        <div class="column">
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                      <label>{{ __('Your monitor')}}</label>
                      <select class="form-control" id='userMonitors'>
                        @foreach($itemsFriendlyName as $key=>$value)
                           <option value="{{$key}}">{{$value['friendly_name']}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                </div>
            </div>


            {{-- up time page info Boxes --}}
            <div class="row" id="upTimeInfoBoxes" >
                <div class="col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

                        <div class="info-box-content">
                        <span class="info-box-text">{{ __('Requests')}}</span>
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
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-cloud-upload-alt"></i></i></span>

                        <div class="info-box-content">
                        <span class="info-box-text">{{ __('Uptime')}}</span>
                        <span class="info-box-number" id="upTime">
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

                <div class="col-md-3 justify-content-center">
                    <div class="chosenDayDateLable" id="chosenDayDateLable">{{ __('There is no date to display!')}}</div>
                    <div class="info-box-content">
                        <div class="easy-pie-chart-box">
                            <span style="margin: 0 auto;">{{ __('Up') }}</span>
                            <div class="box">
                                <div class="chart" id="upChart" data-percent="0">
                                    <span class="percent">0</span>
                                </div>
                            </div>
                        </div>                      
                        <div class="easy-pie-chart-box">
                            <span style="margin: 0 auto;">{{ __('Down')}}</span>
                            <div class="box">
                                <div class="chart" id="downChart" data-percent="0">
                                    <span class="downChartPercent">0</span>
                                </div>
                            </div>
                        </div>
                    </div>
                {{-- There will be automaticali created calenda chart --}}
                </div>

            </div>

    </section>

@stop

@section('css')
<link href="/css/adminlte/user_admin/uptime.css" rel="stylesheet">

{{-- Toastr styles --}}
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" media="all">
@stop

@section('js')
{{-- jquery js script --}}
<script src="https://code.jquery.com/jquery-2.2.4.js"></script> 

{{-- easy-pie-chart --}} 
<script type="text/javascript" src="{{ URL::asset('js/jquery.appear.min.js') }}">></script>
<script type="text/javascript" src="{{ URL::asset('js/jquery.easypiechart.min.js') }}"></script>

<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

{{-- Alert modal window --}}
{{-- toastr --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
{{-- Swal --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.14.0/sweetalert2.min.js"></script>

<script>
    $.noConflict();
    $(function () { 

        const month = new Array(12);
            month[0] = @json( __('January'));
            month[1] = @json( __('February'));
            month[2] = @json( __('March'));
            month[3] = @json( __('April'));
            month[4] = @json( __('May'));
            month[5] = @json( __('June'));
            month[6] = @json( __('July'));
            month[7] = @json( __('August'));
            month[8] = @json( __('September'));
            month[9] = @json( __('October'));
            month[10] = @json( __('November'));
            month[11] = @json( __('December'));

        const weekday = new Array(7);
            weekday[0] = @json( __("Sunday"));
            weekday[1] = @json( __("Monday"));
            weekday[2] = @json( __("Tuesday"));
            weekday[3] = @json( __("Wednesday"));
            weekday[4] = @json( __("Thursday"));
            weekday[5] = @json( __("Friday"));
            weekday[6] = @json( __("Saturday"));
        
        jQuery('#upChart').easyPieChart({
            barColor:'#55c911',
            trackColor:'#d8d7d7f1',
            scaleColor:'#55c911',
            lineWidth: 9,
        });

        jQuery('#downChart').easyPieChart({
            barColor:'#df0505',
            trackColor:'#d8d7d7f1',
            scaleColor:'#df0505',
            lineWidth: 9,
        });

        let friendlyNameCounter = 0;
        let checkCounter = 0;

        //First function that is executed       
        function getStart(){
            let checkHistory = <?php echo json_encode($histories); ?>;
            let friendlyNames = <?php echo json_encode($itemsFriendlyName); ?>;

            if(friendlyNames.length != 0){
                insertData(checkHistory);
            }else{
                $('#userMonitors').attr('disabled', 'disabled');
            }
        }

        getStart();

        //Check that user have any monitors and monitor value
        function userDataCheck(newresponseTime,newfriendlyNames,dropDownVal){

            if(newresponseTime.length != 0 || newresponseTime.length > 0){
                insertData(newresponseTime);
                addOptionsToDropDown(newfriendlyNames,dropDownVal);
            }else{

            }
        }


        //Function add event lisstener to created boxes
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

        //Function create uptime chart
        function createMonthChart(uptimeHistoryData){

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

                    a++;
                }

                if(yearMonth != oldYearMonth){
                    //Check new Month chart
                    newMonthItem =
                        `<div class="col-md-3 monthChart-wrapper" id="${yearMonth}">
                            <div class="monthLable">${month[newDate.getMonth()]} ${newDate.getFullYear()}</div>
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

                if(uptimeHistoryData[i]['value'] == '200' || uptimeHistoryData[i]['value'] == '1'){
                    allDates[a-1]['value'] ++;
                }
                allDates[a-1]['valuesCounter'] ++;

                i++;
            }
                
            let monthStartWeekDay;
            let monthLastDate;
            let monthWrapper;
            let weekWrapper;
            
            let c =0;
            while(Object.keys(allYearMonth).length > c){

                monthWrapper = allYearMonth[c]['id'];
                monthWrapper = document.getElementById("monthWrapper_"+monthWrapper);

                //first month date weekDay
                let firstMonthDay = new Date(allYearMonth[c]['date']);
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
                    let allYearMonth2 = new Date (allYearMonth[c]['date']);

                    if(monthLastDate!=monthDate){
                        allYearMonth2.setDate(monthDate+1);
                    }else{
                        allYearMonth2.setDate(monthDate);
                    }

                    yearMonthWeek = allYearMonth2.getFullYear()+'_'+(allYearMonth2.getMonth()+1)+'_'+moment(allYearMonth2).format('W');
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
                            date = (allYearMonth2.getDate())-1;
                        }

                        let newDayBox =
                                `<div class="dayBox" style="background-color: #a0a0a0;" id="${date}" title="no data" data-toggle="popover" data-trigger="hover" data-content="${ @json( __('Data is not available'))}">
                                    <div class="content d-none" >
                                       
                                    </div>
                                </div>`;

                       let i=0;

                       while((Object.keys(allDates).length) > i){
                            let color;
                            let math = Math.round((allDates[i]['value'] *100)/allDates[i]['valuesCounter']);
                            if(math>60){
                                color = 'green';
                            }else if(math<=60 && math>=50){
                                color = 'yellow';
                            }else{
                                color = 'red';
                            }

                            let checkMonthYear = {
                                1:allYearMonth2.getFullYear()+' '+allYearMonth2.getMonth(),
                                2:allDates[i]['date'].getFullYear()+' '+allDates[i]['date'].getMonth(),
                            };

                           if(allDates[i]['date'].getDate() == date  && checkMonthYear[1] === checkMonthYear[2]){
                            newDayBox =
                                `<div class="dayBox" style="background-color:${color};" id="${date}">
                                    <div class="content d-none">
                                        <div class="contentWrapper">
                                            <div class="contentWrapper_label">${weekday[allDates[i]['date'].getDay()]}  ${(allDates[i]['date'].getDate())}</div>
                                            <div class="uptimeNumber"> ${math}%</div>
                                            <button class="btnMore">${ @json( __('More info'))}</button>
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

            addEventListenerToMonthChartBoxes(allDates);
            addEventToMoreButton(allDates);

        }

        function addEventToMoreButton(allDates){
            let coll = document.getElementsByClassName("btnMore");
            let downBar =document.getElementById("downBar");

            let sizeOfallDates= (Object.keys(allDates).length)-1;

            if(allDates[sizeOfallDates] != null){
                jQuery('.percent').text(`${allDates[sizeOfallDates]['value']}`);
                jQuery(".downChartPercent").text(allDates[sizeOfallDates]['valuesCounter']-allDates[sizeOfallDates]['value']);
                jQuery('#upChart').data('easyPieChart').update(`${allDates[sizeOfallDates]['value']*100/allDates[sizeOfallDates]['valuesCounter']}`);
                jQuery('#downChart').data('easyPieChart').update(`${(allDates[sizeOfallDates]['valuesCounter']-allDates[sizeOfallDates]['value'])*100 /allDates[sizeOfallDates]['valuesCounter']}`);
                jQuery('#chosenDayDateLable').text(allDates[sizeOfallDates]['date'].getDate() + ' ' + month[allDates[sizeOfallDates]['date'].getMonth()] + ' ' + allDates[sizeOfallDates]['date'].getFullYear());
            }else{
                jQuery('.percent').text('0');
                jQuery(".downChartPercent").text('0');
                jQuery('#upChart').data('easyPieChart').update(0);
                jQuery('#downChart').data('easyPieChart').update(0);
                jQuery('#chosenDayDateLable').text(@json( __('There is no date to display!')  ));
                toastr.warning( @json( __('There is no data yet!')  ));
            }

            //Add event listener
            for (let h = 0; h < coll.length; h++) {
                coll[h].addEventListener("click", function() {
                    jQuery('.percent').text(allDates[h]['value']);
                    jQuery(".downChartPercent").text(allDates[h]['valuesCounter']-allDates[h]['value']);
                    jQuery('#upChart').data('easyPieChart').update(`${allDates[h]['value']*100/allDates[h]['valuesCounter']}`);
                    jQuery('#downChart').data('easyPieChart').update(`${(allDates[h]['valuesCounter']-allDates[h]['value'])*100 /allDates[h]['valuesCounter']}`);
                    jQuery('#chosenDayDateLable').text(allDates[h]['date'].getDate() + ' ' + month[allDates[h]['date'].getMonth()] + ' ' + allDates[h]['date'].getFullYear());
                })
            }
        }

        //Display new info into info labels,boxes
        function displayNewInfo(uptimeHistory){
            let checkCount = Object.keys(uptimeHistory).length;
            $("#requests").text(checkCount);

            let positiveData = 0;
            for (const [key, value] of Object.entries(uptimeHistory)) {
                if(value['value'] == 200 ||  value['value'] == 1){
                    positiveData++;
                }
            }

            if(checkCount != 0){
                $("#upTime").text(Math.round((positiveData*100) / checkCount) + '%');
            }else{
                $("#upTime").text('0%');
            }

        } 
 
        //Costomize and insert new data to charts and labels
        function insertData(newUptimehistory){
            createMonthChart(newUptimehistory);
            displayNewInfo(newUptimehistory);
            $('[data-toggle="popover"]').popover(); 
        }

        //Insert new items to friendly name drop down form
        function addOptionsToDropDown(friendlyNames,dropDownValue){
            let dropDownUserMonitors = document.getElementById('userMonitors');
            let dropDownUserMonitorsValue;

            if(dropDownValue != null){
                dropDownUserMonitorsValue = dropDownValue.friendly_name;
            }else{
                dropDownUserMonitorsValue = $("#userMonitors").val();
            }

            let dropDownElements =document.getElementsByTagName('option');

            //Remove all options that exists
            $("#userMonitors option").remove();

            //Add new items to user checks drop down form
            for (let x in friendlyNames) {
                newPersonItem =`
                                <option value='${x}' >${friendlyNames[x]['friendly_name']}</option>
                            `;
                const position = "beforeend";
                dropDownUserMonitors.insertAdjacentHTML(position,newPersonItem);
            }

            //Set Current check friendly name to dropDown
            $("#userMonitors").val(dropDownUserMonitorsValue);
            
        }
        
        function callController(){
            //Remove all old monthChart elements
            $('.monthChart-wrapper').remove();
            
            //Get selected items id
            const itemid = $("#userMonitors option:selected").val();

            $.ajax( {
            type:'POST',
            header:{
            'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            },
            url:"/user/monitoring/uptime",
            data:{
            _token: "{{ csrf_token() }}",
            dataType: 'json', 
            contentType:'application/json', 
            itemId: itemid,
            }


            })
          .done(function(data) {
                insertData(data.histories);
                addOptionsToDropDown(data.itemsFriendlyName,null);
          })
          .fail(function() {
                alert(@json( __("error")));
          });
        }

        $("#userMonitors").change(function(){
            callController();
        });

    })
</script>

@stop
