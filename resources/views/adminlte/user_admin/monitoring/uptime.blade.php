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
                    <label>{{ __('Your monitor')}}</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-desktop"></i></span>
                        </div>
                        <select class="form-control" id='userMonitors'>
                            {{-- Automatically generated options --}}
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <label>{{ __('Period')}}</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-calendar-day"></i></span>
                        </div>
                        <select class="form-control" id='selectPeriod'>
                            <option value="0">This month</option>
                            <option value="1">Last 2 months</option>
                            <option value="5">Last 6 months</option>
                            <option value="9">Last 10 months</option>
                            <option value="11">Last 12 months</option>
                        </select>
                    </div>
                </div>
            </div>


            {{-- Info Boxes --}}
            <div class="row" id="upTimeInfoBoxes" >
                {{-- Requests number --}}
                <div class="col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>
                        <div class="info-box-content">
                        <span class="info-box-text">{{ __('Requests')}}</span>
                        <span class="info-box-number" id="requests">
                        </span>
                        </div>
                    </div>
                </div>
                
                {{-- Uptime in percent--}}
                <div class="col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-cloud-upload-alt"></i></i></span>
                        <div class="info-box-content">
                        <span class="info-box-text">{{ __('Uptime')}}</span>
                        <span class="info-box-number" id="upTime">
                        </span>
                        </div>
                    </div>
                </div>

            </div>


            {{-- up time month statistic --}}
            <div class="row">

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
                </div>

                <div class="col-md-9">
                    <div class="uptimeChart" id="upTimeChart">

                    </div>
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

{{-- Date script --}}
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

{{-- Alert modal window --}}
{{-- toastr --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
{{-- Swal --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.14.0/sweetalert2.min.js"></script>

<script>
    $.noConflict();
    $(function () { 
        const MonthNames = new Array(12);
            MonthNames[0] = @json( __('January'));
            MonthNames[1] = @json( __('February'));
            MonthNames[2] = @json( __('March'));
            MonthNames[3] = @json( __('April'));
            MonthNames[4] = @json( __('May'));
            MonthNames[5] = @json( __('June'));
            MonthNames[6] = @json( __('July'));
            MonthNames[7] = @json( __('August'));
            MonthNames[8] = @json( __('September'));
            MonthNames[9] = @json( __('October'));
            MonthNames[10] = @json( __('November'));
            MonthNames[11] = @json( __('December'));

        const WeekdayNames = new Array(7);
            WeekdayNames[0] = @json( __("Sunday"));
            WeekdayNames[1] = @json( __("Monday"));
            WeekdayNames[2] = @json( __("Tuesday"));
            WeekdayNames[3] = @json( __("Wednesday"));
            WeekdayNames[4] = @json( __("Thursday"));
            WeekdayNames[5] = @json( __("Friday"));
            WeekdayNames[6] = @json( __("Saturday"));
        
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

        function removeOptions(selectElement) {
            var i, len = selectElement.options.length - 1;
            for(i = len; i >= 0; i--) {
                selectElement.remove(i);
            }
        }

        function setNewMonitorOptions(monitors){
            const selectMonitorForm = document.getElementById('userMonitors');

            removeOptions(selectMonitorForm);

            if(Object.keys(monitors)){
                // convert object to key's array
                const keys = Object.keys(monitors);

                // iterate over object
                keys.forEach((key) => {
                    const optionValue = key;
                    const optionText = monitors[key].friendly_name;

                    var option = document.createElement("option");
                    option.text = optionText;
                    option.value = optionValue;

                    selectMonitorForm.add(option);
                });
            }else{
                $('#userMonitors').attr('disabled', 'disabled');
            }
        }

        function checkMonitorHistory(history){
            removeUptimeChart()

            if(history.length){
                createUptimeChart(history);
            }else{
                console.log('is empty');
            }
        }

        //First function that is executed       
        function getStart(){
            const history = <?php echo json_encode($histories); ?>;
            const monitorNames = <?php echo json_encode($itemsFriendlyName); ?>;

            setNewMonitorOptions(monitorNames)

            checkMonitorHistory(history)
        }

        getStart();

        function removeUptimeChart(){
            document.getElementById('upTimeChart').innerHTML = "";
        }

        function sortData(history){
            let lastYear = 0;
            let lastMonth = 0;
            let lastWeek = 0;
            let lastDate = 0;
            let sortedHistory = {};

            let i =0;
            for(i; i<history.length; i++){
                let clock = history[i].clock;
                let date = new Date(clock*1000)
                const value = history[i].value;

                if(lastYear != date.getFullYear()){
                    lastYear = date.getFullYear()
                    sortedHistory[lastYear] = {}  
                }

                if(lastMonth != date.getMonth()+1){
                    lastMonth = date.getMonth()+1
                    sortedHistory[lastYear][lastMonth] = {}
                }

                if(lastWeek != moment(date).format('W') || !sortedHistory[lastYear][lastMonth][lastWeek]){
                    lastWeek = moment(date).format('W')
                    sortedHistory[lastYear][lastMonth][lastWeek] = {}
                }

                if(lastDate != moment(date).format("D")){
                    lastDate = moment(date).format("D")

                    sortedHistory[lastYear][lastMonth][lastWeek][lastDate] = 
                    {
                        'up' : 0,
                        'down' : 0
                    }
                }

                if(value == 200 || value == 1){
                    sortedHistory[lastYear][lastMonth][lastWeek][lastDate].up += 1;
                }else{
                    sortedHistory[lastYear][lastMonth][lastWeek][lastDate].down += 1;
                }
            }
            
            return sortedHistory;
        }

        function addTitle(element, year, month ){
            let titleElement = document.createElement('div');
            titleElement.classList.add('uptimeChart-title');
            titleElement.innerHTML  = MonthNames[month-1] +" "+ year;

            element.appendChild(titleElement);
            return element;
        }

        function addMontWrapper(element, year, month ){
            let monthWrapper = document.createElement('div');
            monthWrapper.classList.add('uptimeChart-monthBox');
            monthWrapper.setAttribute("id", year+'-'+month);

            element.appendChild(monthWrapper);
            return element;
        }

        function createUptimeChartWripperHTML(newYear, newMonth){
            let element = document.createElement('div');
            element.classList.add('uptimeChart-wrapper');

            elementWithTitle = addTitle(element, newYear, newMonth);
            elementWithTitle = addMontWrapper(element, newYear, newMonth);

            const wrapper = document.getElementById('upTimeChart');
            wrapper.appendChild(element);
        }

        function addDateBoxes(newYear, newMonth){

            let firstMonthDayFound = false;
            let datum = new Date(Date.UTC(newYear,newMonth-1,'01','00','00','00'));
            const monthLastDate = new Date(datum.getFullYear(), datum.getMonth() + 1, 0).getDate();

            let monthFirstWeekday = datum.getDay();
            let firstMonthWeek = moment(datum).format('W');
            const firstWeekBox = document.getElementById(newYear+'-'+newMonth+'-'+firstMonthWeek);
            let i = 1;
            while(firstMonthDayFound != true){
                if(i == 8){
                    i=0;
                }

                if(WeekdayNames[monthFirstWeekday] != WeekdayNames[i]){
                    let transperentBox = document.createElement('div');
                    transperentBox.classList.add('uptimeChart-dayBox');
                    transperentBox.classList.add('noColor');
                    firstWeekBox.appendChild(transperentBox);
                }else{
                    firstMonthDayFound = true;
                }
                i++;
            }

            for(let k=1; k<=monthLastDate; k++){
                let date = new Date(Date.UTC(newYear,newMonth-1,k,'00','00','00'));
                let dateWeek = moment(date).format('W'); 
                const weekBox = document.getElementById(newYear+'-'+newMonth+'-'+dateWeek);
                let transperentBox = document.createElement('div');
                transperentBox.classList.add('uptimeChart-dayBox');
                transperentBox.classList.add('gray');
                let elementId = newYear + '-'+k+'-'+newMonth;
                transperentBox.setAttribute("id", elementId );
                weekBox.appendChild(transperentBox);
            }

        }

        function addColorToDateBoxes(element, value){
            let checkSum = value.up + value.down;
            let upInPercent = roundNumber((value.up * 100)/checkSum, 2);
            let downInPercent = 100 - upInPercent;

            if(upInPercent > 61){
                element.classList.remove('gray');
                element.classList.add('green');
            }else if(upInPercent > 49){
                element.classList.remove('gray');
                element.classList.add('yellow');
            }else{
                element.classList.remove('gray');
                element.classList.add('red');
            }
        }

        function addContentToDateBoxes(element, value, day, date){
            let checkSum = value.up + value.down;
            let upInPercent = roundNumber((value.up * 100)/checkSum, 2);
            
            let contentCard = document.createElement('div');
            contentCard.classList.add('uptimeChart-boxContentCard');
            let elementId = element.id+'-content';
            contentCard.setAttribute("id", elementId );

            let contentCardHeader = document.createElement('div');
            contentCardHeader.classList.add('uptimeChart-boxContentCardHeader');
            contentCardHeader.innerHTML = WeekdayNames[day]+' '+ date; 
            contentCard.appendChild(contentCardHeader);

            let contentCardBody = document.createElement('div');
            contentCardBody.classList.add('uptimeChart-boxContentCardBody');

            if(upInPercent > 60) {
                contentCardBody.style.borderBottom = "5px solid rgba(0, 128, 0, 0.81)";
            }else if(upInPercent > 49) {
                contentCardBody.style.borderBottom = "5px solid rgba(255, 255, 0, 0.81)";
            }else {
                contentCardBody.style.borderBottom = "5px solid rgba(173, 5, 5, 0.81)";
            }
            contentCardBody.innerHTML = upInPercent + '%'; 
            contentCard.appendChild(contentCardBody);

            element.appendChild(contentCard);

            element.addEventListener("mouseover", () =>{
                contentCard.style.display = 'block';
            });

            element.addEventListener("mouseleave", () =>{
                contentCard.style.display = 'none';
            });

        }

        function addWeekWrapper(newYear, newMonth){
            let lastWeekNr = -1;
            let weekNumbers = [];
            let datum = new Date(Date.UTC(newYear,newMonth-1,'01','00','00','00'));
            //Get current month Last date
            const monthLastDate = new Date(datum.getFullYear(), datum.getMonth() + 1, 0).getDate();

            //Get month all weeks Numbers
            for(let i = 1; i<=monthLastDate; i++ ){
                let datum = new Date(Date.UTC(newYear,newMonth-1,i,'00','00','00'));
                let currentWeekNr = moment(datum).format('W');
                if(lastWeekNr != currentWeekNr){
                    weekNumbers.push(currentWeekNr)
                    lastWeekNr = currentWeekNr
                }
            }

            for(let i=0; i<weekNumbers.length; i++){
                const monthWrapper = document.getElementById(newYear+'-'+newMonth);
                let weekBoxElement = document.createElement('div');
                weekBoxElement.classList.add('uptimeChart-weekBox');
                weekBoxElement.setAttribute("id", newYear+'-'+newMonth+'-'+weekNumbers[i]);
                monthWrapper.appendChild(weekBoxElement);
            }

            addDateBoxes(newYear, newMonth);
        }

        function roundNumber(number,numbersDecimalPlaces){
            let roundedNumber = Math.round(number * Math.pow(10, numbersDecimalPlaces)) / Math.pow(10, numbersDecimalPlaces);

            return roundedNumber;
        }

        function dataBoxAddEventOnClick(element, date, value){
            element.addEventListener("click", () =>{
                let checkSum = value.up + value.down;
                let upInPercent = roundNumber((value.up * 100)/checkSum, 2);
                let downInPercent = roundNumber(100-upInPercent, 2);

                //Update pie chart
                jQuery('#upChart').data('easyPieChart').update(upInPercent);
                jQuery('#downChart').data('easyPieChart').update(downInPercent);

                //Set pie chart text
                jQuery('#upChart span').text(value.up);
                jQuery('#downChart span').text(value.down);

                const pieChartTitle = document.getElementById('chosenDayDateLable');
                pieChartTitle.innerHTML = displayDate
            });
        }

        function createUptimeChart(history){
            const sortedData = sortData(history)
            const lastData = {
                'date' : 'There is no date to display!',
                'upPercent': 0,
                'upCheckCount': 0,
                'downPercent': 0,
                'downCheckCount': 0
            }
            const generalData = {
                'up': 0,
                'down': 0
            }

           for (const [year, months] of Object.entries(sortedData)) {
                for (const [month, weeks] of Object.entries(months)) {
                    createUptimeChartWripperHTML(year, month);
                    addWeekWrapper(year, month);

                    for (const [week, dates] of Object.entries(weeks)) {
                        for (const [date, value] of Object.entries(dates)) {
                            const elementDayBox = document.getElementById(year+'-'+date+'-'+month);
                            addColorToDateBoxes(elementDayBox, value);

                            let datum = new Date(Date.UTC(year,month-1,date,'00','00','00'));
                            let day = datum.getDay();
                            addContentToDateBoxes(elementDayBox, value, day, date);

                            const displayDate = date+' '+MonthNames[month-1]+' '+year;
                            dataBoxAddEventOnClick(elementDayBox, date, value);

                            // Update general data
                            generalData.up += value.up
                            generalData.down += value.down

                            //Save last data
                            let checkSum = value.up + value.down;
                            let upInPercent = roundNumber((value.up * 100)/checkSum, 2);
                            let downInPercent = roundNumber(100-upInPercent, 2);

                            lastData.date = displayDate;
                            lastData.upPercent = upInPercent;
                            lastData.upCheckCount = value.up;
                            lastData.downPercent = downInPercent;
                            lastData.downCheckCount = value.down;
                        }   
                    }      
                }        
            }

            //Update pie chart
            jQuery('#upChart').data('easyPieChart').update(lastData.upPercent);
            jQuery('#downChart').data('easyPieChart').update(lastData.downPercent);

            //Set pie chart text
            jQuery('#upChart span').text(lastData.upCheckCount);
            jQuery('#downChart span').text(lastData.downCheckCount);

            const pieChartTitle = document.getElementById('chosenDayDateLable');
            pieChartTitle.innerHTML = lastData.date


            let checkSum = generalData.up + generalData.down;
            let upInPercent = roundNumber((generalData.up * 100)/checkSum, 2);

            const requestInfoBox = document.getElementById('requests');
            requestInfoBox.innerHTML = checkSum

            const upInfoBox = document.getElementById('upTime');
            upInfoBox.innerHTML = upInPercent + ' %'

        }

        function callController(){
            //Remove all old monthChart elements
            $('.monthChart-wrapper').remove();
            
            //Get selected items id
            const itemid = $("#userMonitors option:selected").val();
            const periodInMonth = $("#selectPeriod option:selected").val();

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
            period: periodInMonth
            }


            })
          .done(function(data) {

                checkMonitorHistory(data.histories);
          })
          .fail(function() {
                alert(@json( __("error")));
          });
        }

        $("#userMonitors").change(function(){
            callController();
        });

        $("#selectPeriod").change(function(){
            callController();
        });

    })
</script>

@stop
