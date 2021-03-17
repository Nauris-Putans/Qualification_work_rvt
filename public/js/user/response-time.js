$(function () {  

    let endDate = new Date();
    let startDate = new Date(endDate);
    let currentHistory;
    let currentChartType = 0;
    let splitedHystory = [];
    let sortedHistoryIndex = 0;

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

    //Function that display new info to info labels,boxes
    function displayNewInfo(responseSpeedMS,checkCount){
        OldLastCheckValue = document.getElementById('lastCheckIcon');

        OldLastCheckValue.remove();
        $("#lastCheckValue").text('');

        lastCheckValue = document.getElementById('lastCheckValue');
        lastChecksDiference = Math.round((responseSpeedMS[checkCount-1] - responseSpeedMS[checkCount-2]) * Math.pow(10, 4)) / Math.pow(10, 4);
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
                <i ${lastCheckIcon} id="lastCheckIcon"></i>${lastChecksDiference}
                `;
        const position = "beforeend";
        lastCheckValue.insertAdjacentHTML(position,newValue);
    } 

    //Check that user have any monitors and monitor value
    function dataCheck(newresponseTime,newfriendlyNames,dropDownVal){

      const responseTimeInfoBoxes = document.getElementById("responseTimeInfoBoxes");
      const responseChart = document.getElementById("responseChart");
      const weekDayChartBox = document.getElementById("weekdayChartBox");
      const infoAlert = document.getElementById("infoAlert");

      if(newfriendlyNames.length === 0){
        $('#userMonitors').attr('disabled', 'disabled');
        $('#datePicker').attr('disabled', 'disabled');
        $('#timeButton').attr('disabled', 'disabled');
      }else{
        $('#userMonitors').removeAttr('disabled');
        $('#datePicker').removeAttr('disabled');
        $('#timeButton').removeAttr('disabled');

        addOptionsToDropDown(newfriendlyNames, dropDownVal);
      }

      if(Object.keys(newresponseTime).length < 2 ){
        if(responseTimeInfoBoxes.classList.toggle("d-none") === true){
          responseChart.classList.toggle("d-none");
          weekDayChartBox.classList.toggle("d-none");
          infoAlert.classList.toggle("d-none");
        }else{
          responseTimeInfoBoxes.classList.toggle("d-none");
        }

      }else{
        if(responseTimeInfoBoxes.classList.toggle("d-none") === true){
          responseTimeInfoBoxes.classList.toggle("d-none");
        }else{
          responseChart.classList.toggle("d-none");
          weekDayChartBox.classList.toggle("d-none");
          infoAlert.classList.toggle("d-none");
        }
 
        const newHystoryData = spliteHistory();
        insertData(newHystoryData);

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
          paginationList += `<li class="page-item active"><a id="pagination${i}" class="page-link">${i}</a></li>`
        }else{
          paginationList += `<li class="page-item"><a id="pagination${i}" class="page-link">${i}</a></li>`;
        }
      }

      $( "#paginationWrapper" ).append( `
          <li class="page-item ${buttonStatus}" id="previosPagination1">
            <a id="previosPagination" class="page-link page-link-left" aria-label="Previous">
              <span aria-hidden="true">&laquo;</span>
            </a>
          </li>
          ${paginationList}
          <li class="page-item disabled">
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

    //Get values from controller MonitoringPageSpeedController
    function setData(){
        let checkHistory = <?php echo json_encode($histories); ?>;
        let checkFriendlyName = <?php echo json_encode($itemsFriendlyName); ?>;
        const checkItemsIds = <?php echo json_encode($itemsIds); ?>;

        //Insert new Date to date rang picker
        $('#datePicker').daterangepicker({ startDate:  startDate, endDate: endDate });

        startDate = Math.floor(Date.parse(startDate) / 1000);
        endDate = Math.floor(Date.parse(endDate) / 1000);

        currentHistory = checkHistory;
        let optionSelectedId =[];
 
        if(Object.keys(checkFriendlyName).length != 0){
          optionSelectedId =['item'];
          optionSelectedId['item'] = checkItemsIds[0]['item'];
          //Will be set as current value in drop down box
          let checkLastFriendlyName = checkItemsIds[0].item_id;

          dataCheck(checkHistory,checkFriendlyName,checkLastFriendlyName);
        }else{
          dataCheck(checkHistory,[],[]);
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
      // function chartIt(){
      // Get context with jQuery - using jQuery's .get() method.
      let areaChartCanvas = $('#areaChart').get(0).getContext('2d');
  
      let gradientStroke = areaChartCanvas.createLinearGradient(0,200,10, 0,100,20);
          gradientStroke.addColorStop(0, "rgba(60,141,188,0.9)");
          gradientStroke.addColorStop(1, "rgba(60,141,188,0.2)");
 

      var areaChartData = {
          labels  : [],
          datasets: [
          {
              label               : 'Response time(ms)',
              backgroundColor     : gradientStroke,
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

      setData();

      //Costomize and insert new data to charts and labels
      function insertData(newresponseTime){
        
        let speed = new Array();
        let clock = new Array();
        let clockForWeekChart = new Array();

        let checkCounter = 0;

        let minResponseTime = 10;
        let maxResponseTime = 0;
        let averageResponseTime = 0;

        for( const value in newresponseTime){


            //round number to 4 numbers after ,
            speed[checkCounter] = Math.round(newresponseTime[value].value * Math.pow(10, 4)) / Math.pow(10, 4);
            
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
            
            clock[checkCounter] = newresponseTime[value].clock;
            clock[checkCounter] = moment(clock[checkCounter]*1000).format("DD-MM-YYYY HH:mm:ss");

            clockForWeekChart[checkCounter] = newresponseTime[value].clock;
            
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

      function costomizeData(history){
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
            url:"/user/monitoring/page-speed",
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
              newdata = costomizeData(data);
              dataCheck(newdata.histories,data.itemsFriendlyName,data.selectedId);
            })
            .fail(function() {
                alert("error");
            });
        }
      }

      //Insert new items to friendly name drop down form
      function addOptionsToDropDown(friendlyNames,dropDownValue){

          let dropDownCheckType = document.getElementById('userMonitors');

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

    $('#radioOption1').click(function(){
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
    });

    $('#radioOption2').click(function(){
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