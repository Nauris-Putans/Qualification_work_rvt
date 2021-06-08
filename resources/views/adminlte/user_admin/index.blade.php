@extends('adminlte::page')
@section('title', __('Dashboard'))

@section('content')
<section class="fixedSettingsContainer" id="setingsSlideBox">
    <div class="fixedSettingsContainer-btn" id="settingsShowBtn">
        <i class="fas fa-chevron-left"></i>
    </div>
    <div class="fixedSettingsContainer-wrapper">
        <div class="button-wrapper">
            <a class="btn btn-modal" id="settingsBtn">
                <i class="fas fa-cog"></i>
            </a>
            <div id='saveInProcess' class="spinner-border text-primary" style="display: none" role="status">
                <span class="visually-hidden"></span>
            </div>
            <a class="btn btn-save" id="savePosition">
                {{ __('Save')}}
            </a>
        </div>
    </div>
</section>

<section class="dashboard-content">

    <div class="column">
        <div class="row">
            <div class="overview_title">Dashboard</div>
        </div>
        <div class="row">
            <section class="col-lg-7 elementsContainer" id="dashboardContent-left">
                
            </section>
            <section class="col-lg-5 elementsContainer" id="dashboardContent-right">

            </section>
        </div>
    </div>



    {{--Add Item Modal Window  --}}
    <div class="modal" tabindex="-1" id="settingsModal" data-backdrop="static">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">{{ __('Add new item')}}</h5>
              <button type="button" class="modal-close " data-bs-dismiss="modal" aria-label="Close" id="modalCloseTopBtn">
                <i class="fas fa-times"></i>
              </button>
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
                                <option value="chart" >{{ __('Chart')}}</option>
                                <option value="lastChecks">{{ __('Monitor status')}}</option>
                                <option value="groupMemberList">{{ __('member list')}}</option>
                            </select>
                        </div>
                    </div>
                </div>
       
                <div class="settingsWarrning" id="newElementAddWarning">
                    <div class="settingsWarrning-icon">
                        <i class="fas fa-ghost"></i>
                    </div>
                    <div class="settingsWarrning-wrapper">
                        <div class="settingsWarrning-title">INFO!</div>
                        <div class="settingsWarrning-decr">THIS DASHBOARD ELEMENT HAS LIMITS: ONE ELEMENT ON DASHBOARD!</div>
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
                                @if($groupHosts->first() != null)
                                    <select name="monitor" class="form-control select2bs4 select2-hidden-accessible" id='monitor' aria-hidden="true">
                                        @foreach ($groupHosts as $host)
                                            <option value="{{ $host->host }}">{{ $host->friendly_name }}</option>
                                        @endforeach
                                    </select>
                                @else
                                    <select name="monitor" class="form-control select2bs4 select2-hidden-accessible" id='monitor' aria-hidden="true" disabled>
                                    </select>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <label for="chartHeader" class="mt-10">{{ __('Title') }}</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-heading"></i></span>
                                </div>
                                <input type="text" class="form-control form-control-border border-width-2" id="chartHeader" maxlength="20" placeholder="Example">
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-center" style="margin-top: 20px" >
                        <div class="col-sm-4">
                            @if($groupHosts->first() != null)
                            <div class="card chart-settings">
                            @else
                            <div class="card chart-settings d-none">
                            @endif
                                <!-- /.card-header -->
                                <div class="card-body p-0">
                                  <table class="table table-striped">
                                    <thead>
                                      <tr class="d-none">
                                        <th>#</th>
                                        <th>Data type</th>
                                        <th>#</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <tr class="tr-bodyHeader">
                                        <td>
                                            <input  type="checkbox" id="responseTimeCheckbox">
                                        </td>
                                        <td>Response time</td>
                                        <td>
                                            <div id="collapseResponseTimeBtn" class="collapseBtn"><i class="fas fa-plus"></i></div>
                                        </td>
                                      </tr>
                                      <tr class="expandable-body">
                                        <td colspan="5" style="padding: 0">
                                            <div class="chartSettingWrapper" id="collapseResponseTimeBox">
                                                {{-- Color pickers --}}
                                                <div class="settingsBox">
                                                    <div class="settingsDecr">
                                                        Color
                                                    </div>
                                                    <div class="settingsOptions">

                                                        {{-- Color picker background color --}}
                                                        <div id="testChartBgColor" class="input-group colorBtn" data-color="rgba(255,0,0,0.0)"
                                                        title="Using data-color attribute in the colorpicker element">
                                                            <input id="BGColor1" type="hidden" value="rgba(255,0,0,0.0)" class="form-control input-lg"/>
                                                            <span class="input-group-append">
                                                                <span class="input-group-text colorpicker-input-addon"><i></i></span>
                                                            </span>
                                                        </div>

                                                        {{-- Color picker border color --}}
                                                        <div id="testChartLineColor" class="input-group colorBtn" data-color="#FF0000"
                                                        title="Using data-color attribute in the colorpicker element">
                                                            <input id="BorderColor1" type="hidden" value="#FF0000" class="form-control input-lg"/>
                                                            <span class="input-group-append">
                                                                <span class="input-group-text colorpicker-input-addon"><i></i></span>
                                                            </span>
                                                        </div>

                                                        {{-- Color picker hover background color --}}
                                                        <div id="firstBoxHoverBackgroundColor" class="input-group colorBtn" data-color="#B40000"
                                                        title="Using data-color attribute in the colorpicker element">
                                                            <input id="hoverBGColor1" type="hidden" value="#B40000" class="form-control input-lg"/>
                                                            <span class="input-group-append">
                                                                <span class="input-group-text colorpicker-input-addon"><i></i></span>
                                                            </span>
                                                        </div>
    
                                                    </div>
                                                </div>
                                                {{-- Color pickers end --}}

                                                {{-- Border width --}}
                                                <div class="settingsBox">
                                                    <div class="settingsDecr">
                                                        Border width
                                                    </div>
                                                    <div class="settingsOptions">
                                                        <div class="slidecontainer">
                                                            <input type="range" min="1" max="4" value="1" class="slider" id="firstChartBorderWidthSlider">
                                                        </div>

                                                        <div id="firstChartBorderWidthLabel" class="border-width-label">
                                                            1
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- measurement units --}}
                                                <div class="settingsBox">
                                                    <div class="settingsDecr">
                                                        measurement unit
                                                    </div>
                                                    <div class="settingsOptions">
                                                        <select class="custom-select measurement_select" id="responseTimeMeasurementUnit">
                                                            <option value="1">s</option>
                                                            <option value="2">ms</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                {{-- Chart type --}}
                                                <div class="settingsBox">
                                                    <div class="settingsDecr">
                                                        Chart type
                                                    </div>
                                                    <div class="settingsOptions">
                                                        <div class="btn-group btn-group-toggle" id="firstChartType" data-toggle="buttons">
                                                            <label class="btn radio-btn active">
                                                              <input value="line" type="radio" name="firstChartType_options" autocomplete="off" checked=""> Line
                                                            </label>
                                                            <label class="btn radio-btn">
                                                              <input value="bar" type="radio" name="firstChartType_options" autocomplete="off"> Bar
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </td>
                                      </tr>
                                      <tr class="tr-bodyHeader">
                                        <td>
                                            <input  type="checkbox" id="downloadSpeedCheckbox">
                                        </td>
                                        <td style="padding-left: 0; padding-right: 0">Download Speed</td>
                                        <td>
                                            <div id="collapseDownloadSpeedBtn" class="collapseBtn"><i class="fas fa-plus"></i></div>
                                        </td>
                                      </tr>
                                      <tr class="expandable-body">
                                        <td colspan="5" style="padding: 0">
                                            <div class="chartSettingWrapper" id="collapseDownloadSpeedBox">

                                                {{-- Color pickers --}}
                                                <div class="settingsBox">
                                                    <div class="settingsDecr">
                                                        Color
                                                    </div>
                                                    <div class="settingsOptions">
                                                
                                                        {{-- Color picker background color --}}
                                                        <div id="testChartSecondBgColor" class="input-group colorBtn" data-color="rgba(0,0,128,0.0)"
                                                        title="Using data-color attribute in the colorpicker element">
                                                            <input id="BGColor2" type="hidden" value="rgba(0,0,128,0.0)" class="form-control input-lg"/>
                                                            <span class="input-group-append">
                                                                <span class="input-group-text colorpicker-input-addon"><i></i></span>
                                                            </span>
                                                        </div>

                                                        {{-- Color picker border color --}}
                                                        <div id="testChartSecondLineColor" class="input-group colorBtn" data-color="#0000CC"
                                                        title="Using data-color attribute in the colorpicker element">
                                                            <input id="BorderColor2" type="hidden" value="#0000CC" class="form-control input-lg"/>
                                                            <span class="input-group-append">
                                                                <span class="input-group-text colorpicker-input-addon"><i></i></span>
                                                            </span>
                                                        </div>

                                                        {{-- Color picker hover background color --}}
                                                        <div id="secondBoxHoverBackgroundColor" class="input-group colorBtn" data-color="#B40000"
                                                        title="Using data-color attribute in the colorpicker element">
                                                            <input id="hoverBGColor2" type="hidden" value="#B40000" class="form-control input-lg"/>
                                                            <span class="input-group-append">
                                                                <span class="input-group-text colorpicker-input-addon"><i></i></span>
                                                            </span>
                                                        </div>
                                        
                                                    </div>
                                                </div>
                                                {{-- Color pickers end --}}

                                                {{-- Border width --}}
                                                <div class="settingsBox">
                                                    <div class="settingsDecr">
                                                        Border width
                                                    </div>
                                                    <div class="settingsOptions">
                                                        <div class="slidecontainer">
                                                            <input type="range" min="1" max="4" value="1" class="slider" id="secondChartBorderWidthSlider">
                                                        </div>

                                                        <div id="secondChartBorderWidthLabel" class="border-width-label">
                                                            1
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- measurement units --}}
                                                <div class="settingsBox">
                                                    <div class="settingsDecr">
                                                        measurement unit
                                                    </div>
                                                    <div class="settingsOptions">
                                                        <select class="custom-select measurement_select" id="downloadSpeedMeasurementUnit">
                                                            <option value="3">MBps</option>
                                                            <option value="4">KBps</option>
                                                          </select>
                                                    </div>
                                                </div>

                                                {{-- Chart type settings --}}
                                                <div class="settingsBox">
                                                    <div class="settingsDecr">
                                                        Chart type
                                                    </div>
                                                    <div class="settingsOptions">
                                                        <div class="btn-group btn-group-toggle" id="secondChartType" data-toggle="buttons">
                                                            <label class="btn radio-btn active">
                                                            <input value="line" type="radio" name="secondChartType_options" autocomplete="off" checked=""> Line
                                                            </label>
                                                            <label class="btn radio-btn">
                                                            <input value="bar" type="radio" name="secondChartType_options" autocomplete="off"> Bar
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="card card-settings">
                                <div class="card-header" id="templateChartHeader">
                                  <h3 class="card-title" id="templateChartHeaderTitle">Example</h3>
                  
                                  <div class="card-tools">
                                    <button type="button" id="templateChartHeaderToolCollapse" class="btn btn-tool">
                                      <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" id="templateChartHeaderToolRemove" class="btn btn-tool" >
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
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="modalCloseBtn"> {{ __('Close')}}</button>
              {{-- Create area chart button, disable button if there is no available items --}}
              @if($allItems->first() != null)
                <button type="button" id="createNewChart" class="btn btn-primary">{{ __('Create')}}</button>
              @else
                <button type="button" id="createNewChart" class="btn btn-primary" disabled>{{ __('Create')}}</button>
              @endif
              <button type="button" id="createNewLastStatusBtn" style="display: none" class="btn btn-primary">{{ __('Create')}}</button>
              <button type="button" id="createNewGroupMemberElement" style="display: none" class="btn btn-primary">{{ __('Create')}}</button>
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

    <script>
         $(function(){

            document.addEventListener('scroll', function(e) {
                const lastKnownScrollPosition = window.scrollY;
                let top = $('#setingsSlideBox').css('top').replace('px', '');
                top = Math.ceil(56 - lastKnownScrollPosition);

                if (top >= 0) {
                    const topPositionStr = (top + 'px').toString()
                    $('#setingsSlideBox').css({ top: topPositionStr });

                }else{
                    $('#setingsSlideBox').css({ top: '0' });
                }
            });

            $('#settingsShowBtn').click(function() {

                if($('#setingsSlideBox').width() == 0){
                    $('#setingsSlideBox').css('width', '320px')
                    $('#settingsShowBtn').html('<i class="fas fa-chevron-right"></i>')
                }else{
                    hideRightSlideBox();
                }
            });

            function addDragDropEvent(draggables){

                const containers = document.querySelectorAll('.elementsContainer');

                draggables.forEach( draggable => {
                    draggable.addEventListener('dragstart', () => {
                        draggable.classList.add('dragging');
                    })

                    draggable.addEventListener('dragend', () => {
                        draggable.classList.remove('dragging');
                    })
                })

                containers.forEach( container =>{
                    container.addEventListener('dragover', e =>{
                        e.preventDefault();
                        let afterElement = getDragAfterElement(container, e.clientY);
                        if(afterElement != null){
                            afterElement = afterElement
                        }
                        const draggable = document.querySelector('.dragging')

                        if( afterElement == null){
                            container.appendChild(draggable);
                        } else {
                            container.insertBefore(draggable, afterElement);
                        }
                    })
                })
            }

            function getDragAfterElement(container, y){
                const draggableElements = [...container.querySelectorAll('.draggable:not(.dragging)')]
                
                return draggableElements.reduce( (closest, child) => {
                    const box = child.getBoundingClientRect()
                    const offset = y - box.top - box.height / 2

                    if(offset < 0 && offset > closest.offset){
                        return { offset: offset, element: child}
                    } else {
                        return closest
                    }
                }, { offset: Number.NEGATIVE_INFINITY } ).element
            }

            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });

            const elementContainers = ['dashboardContent-left','dashboardContent-right'];
            let testChart;
            let testAreaChart;
            let areaChartNr = 0;
            let dashboardElementCounter = {
                'currentStatusChart': 0,
                'chart': 0,
                'groupMembersList': 0
            }
            let lastElementPosition = <?php echo json_encode($lastElementPosition); ?>;
            let monitorItems = <?php echo $allItems; ?>;

            //Rang pickers
            const secondHoverSlider = document.querySelector('#secondChartBorderWidthSlider');
            const firstHoverSlider = document.querySelector('#firstChartBorderWidthSlider');

            //Display posible item types[Download, Response time] depending on zabbix host
            function getHostPosibleDataTypes(){
                let hostId = $('#monitor option:selected').val();
                let selectedItems = [];

                let i=0;
                for(const key in monitorItems){
                    const itemHostID = monitorItems[key].host;
                    const itemCheckType = monitorItems[key].check_type_name;

                    if(itemHostID == hostId && itemCheckType != 'Uptime' ){
                        selectedItems[i] = {};
                        selectedItems[i].itemID = monitorItems[key].item_id;

                        if(itemCheckType == 'Download speed'){
                            selectedItems[i].itemType = 1;
                        }else{
                            selectedItems[i].itemType = 0;
                        }
                        i++;
                    }
                }

                return selectedItems;
            }

            function hideItemTypeCheckboxes(){
                const itemTypes = ['responseTimeCheckbox', 'downloadSpeedCheckbox'];

                $('#'+itemTypes[0]).parent().parent().css("display", "none");
                $('#'+itemTypes[1]).parent().parent().css("display", "none");

                $('#'+itemTypes[0]).prop( "checked", true );
                $('#'+itemTypes[1]).prop( "checked", false );
            }

            //Display only settings for items, that host has
            function showItemTypeCheckboxes(hostItems){
                const itemTypes = ['responseTimeCheckbox', 'downloadSpeedCheckbox'];

                for(const key in hostItems){
                    itemTypeID = hostItems[key].itemType;
                    $('#'+itemTypes[itemTypeID]).parent().parent().css("display", "flex");
                }
            }

            $('#responseTimeCheckbox').change( function(){

                const downloadSpeedChecked = $('#downloadSpeedCheckbox').is(':checked');

                if($(this).is(':checked')){
                    //Update testchart colors
                    const chartValues = generateRandomNumericArray(2,5,5);
                    //Set new data
                    chartAddData(testChart, chartValues, 0);
                }else if(!downloadSpeedChecked){
                    $(this).prop( "checked", true )
                }else{
                    //Set new data
                    chartAddData(testChart, [], 0);
                }
            });

            $('#collapseResponseTimeBtn').click(function() {
                $('#collapseResponseTimeBox').toggleClass( "d-block" );

                if (!$('#collapseResponseTimeBox').hasClass("d-block")) {
                    $('#collapseResponseTimeBtn').html('<i class="fas fa-plus"></i>');
                }else{
                    $('#collapseResponseTimeBtn').html('<i class="fas fa-minus"></i>');
                }
            });

            $('#collapseDownloadSpeedBtn').click(function() {
                $('#collapseDownloadSpeedBox').toggleClass( "d-block" );

                if (!$('#collapseDownloadSpeedBox').hasClass("d-block")) {
                    $('#collapseDownloadSpeedBtn').html('<i class="fas fa-plus"></i>');
                }else{
                    $('#collapseDownloadSpeedBtn').html('<i class="fas fa-minus"></i>');
                }
            });

            $('#downloadSpeedCheckbox').change( function(){
                const responseTimeChecked = $('#responseTimeCheckbox').is(':checked');
                const downloadSpeedChecked = $(this).is(':checked');

                if(downloadSpeedChecked){
                    //Update testchart colors
                    const chartValues = generateRandomNumericArray(15,45,5);
                    //Set new data
                    chartAddData(testChart, chartValues, 1);
                }else if(!responseTimeChecked){
                    $(this).prop( "checked", true )
                }else{
                    //Set new data
                    chartAddData(testChart, [], 1);
                }
            });


            //Sliders

            firstHoverSlider.oninput = function() {
                $('#firstChartBorderWidthLabel').html(this.value);
                chartUpdateBorderSize(testChart, this.value, 0);
            }

            firstHoverSlider.addEventListener('mousemove', function(){
                let x = this.value-this.min;
                let valueInPercent = (100*x/(this.max-this.min));
                let color = 'linear-gradient(90deg, #17a2b8 '+valueInPercent+'%, rgb(214,214,214) '+valueInPercent+'%)';
                this.style.background = color;
            });

            secondHoverSlider.oninput = function() {
                $('#secondChartBorderWidthLabel').html(this.value);
                chartUpdateBorderSize(testChart, this.value, 1);
            }

            secondHoverSlider.addEventListener('mousemove', function(){
                let x = this.value-this.min;
                let valueInPercent = (100*x/(this.max-this.min));
                let color = 'linear-gradient(90deg, #17a2b8 '+valueInPercent+'%, rgb(214,214,214) '+valueInPercent+'%)';
                this.style.background = color;
            });


            //Chart Header, title changed
            $('#chartHeader').keyup(function(){
                let newValue = $(this).val();
                if(newValue.length < 21 && newValue.length != 0){
                    $('#templateChartHeaderTitle').html(newValue);
                }else if(newValue.length > 20){
                    newValue = newValue.substring(0, 17) + '...';
                    $('#templateChartHeaderTitle').html(newValue);
                }else{
                    $('#templateChartHeaderTitle').html('Example');
                }
            });

            $( "#monitor" ).change(function() {
                hideItemTypeCheckboxes();
                const hostItems = getHostPosibleDataTypes();
                showItemTypeCheckboxes(hostItems);

                //Update testchart graph(response time) with new data
                const chartValues = generateRandomNumericArray(2,5,5);
                chartAddData(testChart, chartValues, 0);
                //Set no data to testchart graph(download speed)
                chartAddData(testChart, [], 1);
            });
 
            function generateRandomNumericArray(minValue, maxValue, valueCount){
                let numericArray = [];
                maxValue -= minValue;

                if(maxValue>0 && minValue>0){
                    let i=0;
                    for(i; i<valueCount; i++){
                        numericArray[i] = Math.floor(Math.random() * maxValue) + minValue;
                    }
                }

                return numericArray;
            }

            function addNewChart(newData, chartData){
                if(newData != null && newData[0].length > 1){

                    const elementId = chartData.elementId;
                    const elementName = chartData.name;
                    const elementHtml = getChartHTML(elementId, elementName);
                    const containerIndex = chartData.container - 1;

                    insertNewElementIntoContainer(elementContainers[containerIndex], elementHtml);

                    //get chart type
                    const chartTypes = ['line', 'bar'];
                    let types = [];
                    for(const key in chartData.items){
                        const typeIndex = chartData.items[key].chart_type - 1;
                        types[key] = chartTypes[typeIndex];
                    }

                    //Create new chart
                    const areaChartCanvas = $(`#areaChart${elementId}`).get(0).getContext('2d');
                    const createdChart = chartCreate(areaChartCanvas, types);
                    //Set chart colors an dborder width   
                    for(let i=0; i<chartData['color'].length; i++){
                        // Update chart colors
                        chartUpdateColor(createdChart, chartData['color'][i], i);
                        chartUpdateBorderSize(createdChart, chartData['color'][i].borderWidth, i);
                    }

                    //get chart type
                    let charDataLabeles = [];
                    let graphNumbers = [];
                    for(const key in chartData.items){
                        const type = chartData.items[key].check_type;
                        const unit = chartData.items[key].symbol;
                        if(type == 1){
                            charDataLabeles[key] = 'Response time(' + unit + ')';
                        }else{
                            charDataLabeles[key] = 'Download speed(' + unit + ')';
                        }
                        graphNumbers[key] = key;
                    }
                    chartAddLabels(createdChart, charDataLabeles, newData[0], graphNumbers);

                    //Add values to chart
                    for(let i=0; i<newData[1].length; i++){
                        chartAddData(createdChart, newData[1][i], i);
                    }

                    const removeBtnId = `areaChartRemoveBtn${elementId}`;
                    addRemoveEventToButton(elementId, removeBtnId);
                }else{
                    const elementId = chartData.elementId;
                    const elementName = chartData.name;
                    const elementHTML = noDataElementHTML(elementId, elementName);

                    const containerIndex = chartData.container - 1;
                    insertNewElementIntoContainer(elementContainers[containerIndex], elementHTML);

                    const removeBtnId = `removeElementBtn${elementId}`;
                    addRemoveEventToButton(elementId, removeBtnId);
                }

                dashboardElementCounter.chart++ ;
            }

            //FUNCTIONS
            function getStartDashboard(){

                hideItemTypeCheckboxes();
                const hostItems = getHostPosibleDataTypes();
                showItemTypeCheckboxes(hostItems);

                $('#settingsModal').hide();

                let allDashboardElements = <?php echo json_encode($allDashboardItems); ?>;

                for(const property in allDashboardElements){
                    const elementType = allDashboardElements[property]['type'];

                    switch(elementType){
                        case 'currentStatus': {
                            const elementId = allDashboardElements[property]['id'];
                            const lastCheckStatus = allDashboardElements[property]['currentStatus'];
                            const elementHTML = getLastChecksChartHTML(lastCheckStatus,elementId);

                            const containerIndex = allDashboardElements[property]['container'];
                            insertNewElementIntoContainer(elementContainers[containerIndex-1], elementHTML);
                            setNewPieChart(elementId);

                            const removeBtnId = `removeBtn${elementId}`;
                            addRemoveEventToButton(elementId, removeBtnId);

                            dashboardElementCounter.currentStatusChart ++;
                            break;
                        }
                        case 'chart': {

                            const chartData = allDashboardElements[property];
                            const newData = costumizeDataForChart(chartData);

                            addNewChart(newData, chartData);

                            break;
                        }
                        case 'groupMemberList': {
                            let dashboardElement = allDashboardElements[property];
                            const elementId = dashboardElement.uniqIdForItem;
                            const groupMemeber = dashboardElement.members;

                            const elementHTML = getPersonListHTML(elementId, groupMemeber);

                            const containerIndex = allDashboardElements[property].container - 1;
                            insertNewElementIntoContainer(elementContainers[containerIndex],elementHTML);

                            const removeBtnId = `removeBtn${elementId}`;
                            addRemoveEventToButton(elementId, removeBtnId);

                            dashboardElementCounter.groupMembersList++;
                            break;
                        }
                        default:
                            console.log(`Sorry, such element doesn't exist.`);
                    }

                }          

                let draggables = document.querySelectorAll('.draggable');

                addDragDropEvent(draggables);

                createTestChart();
                addNewValuesToTestChart();
                chartUpdateBorderSize(testChart, firstHoverSlider.value, 0); 
                chartUpdateBorderSize(testChart, secondHoverSlider.value, 1);
            }

            function timestampToHumanDate(newData, dateFormat){
                let clock = [];

                for(let i=0; i<newData.length; i++){
                    clock[i] =  new Date(newData[i].clock * 1000);
                    clock[i] = moment(clock[i]).format(dateFormat);
                }

                return clock;
            }

            function createTestChart(){
                //Create new chart
                const testAreaChartCanvas = $('#testAreaChart').get(0).getContext('2d');

                const chartTypes = [
                    $("input[name='firstChartType_options']:checked").val(),
                    $("input[name='secondChartType_options']:checked").val()
                ];

                testChart = chartCreate(testAreaChartCanvas, chartTypes);
                //Set chart colors   
                const chartColors = [
                    {
                    background : $('#testChartBgColor input').val(),
                    border : $('#testChartLineColor input').val(),
                    hoverBackground : $('#firstBoxHoverBackgroundColor input').val()
                    },
                    {
                    background : $('#testChartSecondBgColor input').val(),
                    border : $('#testChartSecondLineColor input').val(),
                    hoverBackground : $('#secondBoxHoverBackgroundColor input').val()
                    }
                ]
                //Update chart colors
                chartUpdateColor(testChart, chartColors[0], 0);
                chartUpdateColor(testChart, chartColors[1], 1);

                const charclock = [1,2,3,4,5];
                const charDataLabeles = ['Response time(s)','Download speed(KBps)'];
                //Set new data
                chartAddLabels(testChart, charDataLabeles, charclock, [0, 1]);
            }

            function destroyChart(chart){
                chart.destroy();
            }

            function addNewValuesToTestChart(){
                const responseTimeIsChecked = $('#responseTimeCheckbox').is(':checked');
                const downloadTimeIsChecked = $('#downloadSpeedCheckbox').is(':checked');

                if(responseTimeIsChecked){
                    const newValues = generateRandomNumericArray(2,5,5);
                    chartAddData(testChart, newValues, 0);
                }

                if(downloadTimeIsChecked){
                    const newValues = generateRandomNumericArray(15,45,5);
                    chartAddData(testChart, newValues, 1);
                }
            }

            $('#firstChartType').change( function(){
                destroyChart(testChart);
                createTestChart();

                addNewValuesToTestChart();
                chartUpdateBorderSize(testChart, firstHoverSlider.value, 0);
                chartUpdateBorderSize(testChart, secondHoverSlider.value, 1);
            });

            $('#secondChartType').change( function(){
                destroyChart(testChart);
                createTestChart();

                addNewValuesToTestChart();
                chartUpdateBorderSize(testChart, firstHoverSlider.value, 0);
                chartUpdateBorderSize(testChart, secondHoverSlider.value, 1);
            });

            getStartDashboard();

            function noDataElementHTML(elementID, elementName){

                let itemNoData = `
                        <div class="card draggable" draggable="true" id="${elementID}">
                            <div class="card-header" >
                                <h3 class="card-title">${elementName}</h3>
                
                                <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" id="removeElementBtn${elementID}" class="btn btn-tool" >
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
                `;

                return itemNoData;
            }

            //Add new data, labels to area chart
            function chartAddLabels(chart, labels, clock, graphs) {
                //Set chart labels
                chart.data.labels = clock;

                for(const key in graphs){
                    chart.data.datasets[graphs[key]].label = labels[graphs[key]];
                }

                chart.update();
                chart.resize();
            }

            //Add new data to chart
            function chartAddData(chart, value, graph) {

                chart.data.datasets[graph].data = value;

                chart.update();
                chart.resize();
            }

            //remove all data, labels from area chart
            function chartRemoveData(chart) {
                while (chart.data.labels.length) {
                    chart.data.labels.pop();
                }

                chart.data.datasets.forEach((dataset) => {
                    while (dataset.data.length) {
                        dataset.data.pop();
                    }
                });
                chart.update();
            }

            //costomize chart line color,backgroun
            function chartUpdateColor(chart, colors, graphIndex) {

                const graphBackgroundColor = colors.background;
                const graphLineColor = colors.border;

                //Graph colors
                chart.data.datasets[graphIndex].backgroundColor = graphBackgroundColor;
                chart.data.datasets[graphIndex].borderColor = graphLineColor;
                //Color change on hover
                if(colors.hoverBackground){
                    chart.data.datasets[graphIndex].hoverBackgroundColor = colors.hoverBackground;
                    chart.data.datasets[graphIndex].hoverBorderColor = colors.hoverBackground;
                }

                //point colors
                chart.data.datasets[graphIndex].pointBackgroundColor = "white";
                chart.data.datasets[graphIndex].pointColor = graphLineColor;
                chart.data.datasets[graphIndex].pointHighlightFill = "white";
                chart.data.datasets[graphIndex].pointHighlightStroke = graphLineColor;
                chart.data.datasets[graphIndex].pointStrokeColor = graphLineColor;

                chart.update();
            }

            //Update chart border Width
            function chartUpdateBorderSize(chart, newBorderWidth, graphIndex) {

                //Graph Border width
                chart.data.datasets[graphIndex].borderWidth = newBorderWidth;

                chart.update();
            }

            //create chart
            function chartCreate(chart, chartType){

                let charts = {
                    datasets: []
                };

                for(let i=0; i<chartType.length; i++){
                    if(chartType[i] == 'line'){
                        charts.datasets[i] = 
                        {
                            type: chartType[i],
                            pointRadius: true,
                            fill: true,
                            borderWidth: 1,
                            pointRadius: 1,
                            pointHoverBorderWidth: 3,
                            pointHoverRadius: 6,
                            // hidden: true
                        }
                    }else{
                        charts.datasets[i] = 
                        {
                            type: chartType[i],
                            fill: true,
                            // hidden: true
                        }
                    }
                }

                const chartData = charts;

                const chartOptions = {
                    maintainAspectRatio : false,
                    responsive : true,
                    tooltips: {
                        // enabled: true,
                        // intersect: false, //Show nearest value
                        mode: 'index',
                    },
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
                                display : true,
                            },
                            ticks: {
                                beginAtZero: true,   // minimum value will be 0.
                            }
                        }]
                    }    
                }

                //Decide which chart type set as grobal type(bar or line)
                let mainBarChart = 'line';
                if(chartType[0] != chartType[1]){
                    mainBarChart = 'bar';
                }else{
                    if(chartType[0] == 'bar'){
                        mainBarChart = 'bar';
                    }
                }

                newChart = new Chart(chart, { 
                    type: mainBarChart,
                    data: chartData, 
                    options: chartOptions
                })

                return newChart;
            }

            function getChartHTML(elementId, name){

                const areaChartHtml = `
                        <div class="card draggable" draggable="true" id="${elementId}">
                            <div class="card-header" id="areaChartHeader${elementId}">
                                <h3 class="card-title">${name}</h3>
                
                                <div class="card-tools">                         
                                    <button type="button" id="areaChartHeaderToolCollapse${elementId}" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" id="areaChartRemoveBtn${elementId}" class="btn btn-tool" >
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <div class="position-relative mb-4" style="min-height: 153px; padding: 20px 10px 0 10px"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                                    <canvas id="areaChart${elementId}" height="153" width="900" class="chartjs-render-monitor"></canvas>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>`

                return areaChartHtml;
            }

            function setNewPieChart(elementId){

                jQuery('#upChart'+elementId).easyPieChart({
                    barColor:'#55c911',
                    trackColor:'#d8d7d7f1',
                    scaleColor:'#55c911',
                    lineWidth: 15,
                });

                jQuery('#downChart'+elementId).easyPieChart({
                    barColor:'#df0505',
                    trackColor:'#d8d7d7f1',
                    scaleColor:'#df0505',
                    lineWidth: 15,
                });


                jQuery('#pausedChart'+elementId).easyPieChart({
                    barColor:'rgba(0, 0, 0, 0.849)',
                    trackColor:'#d8d7d7f1',
                    scaleColor:'rgba(0, 0, 0, 0.849)',
                    lineWidth: 15,
                });
            }

            function insertNewElementIntoContainer(container, element){
                const position = "beforeend";

                const dashboardContent = document.getElementById(container);
                dashboardContent.insertAdjacentHTML(position,element);
            }

            function addRemoveEventToButton(elementId, removeBtnId){

                let itemWrapper = $(`#${elementId}`);
                $(`#${removeBtnId}`).on( "click", function() {
                    removeItem(elementId);
                    itemWrapper.remove();
                });
            }

            function getLastChecksChartHTML(statusValues,elementId){

                const lastCheckHTML = `
                    <div class="card draggable" id="${elementId}" draggable="true">
                        <div class="card-header">
                            <h3 class="card-title">Last check status</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" id="removeBtn${elementId}" class="btn btn-tool" >
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
                                        <div class="chart" id="upChart${elementId}" data-percent="${ statusValues['percentage']['up'] }">
                                            <span class="percent">${ statusValues['values']['up'] }</span>
                                        </div>
                                    </div>
                                </div>                      
                                <div class="easy-pie-chart-box">
                                    <span style="margin: 0 auto;">Down</span>
                                    <div class="box">
                                        <div class="chart" id="downChart${elementId}" data-percent="${ statusValues['percentage']['down'] }">
                                            <span class="percent">${ statusValues['values']['down'] }</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="easy-pie-chart-box">
                                    <span style="margin: 0 auto;">Paused</span>
                                    <div class="box">
                                        <div class="chart" id="pausedChart${elementId}" data-percent="${ statusValues['percentage']['paused'] }">
                                            <span class="percent">${ statusValues['values']['paused'] }</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>`;

                return lastCheckHTML;
            }

            function getPersonListHTML(elementID, groupMembers){
                let persons = '';

                for(const person of groupMembers){
                    const personName = person.name
                    const personId = person.userID
                    const membersSince = person.email_verified_at
                    const gender = person.gender

                    const imagPath = '';

                    if(person.profile_image){
                        imgPath = '..'+person.profile_image;
                    }else{
                        if(gender == 'Male')
                            imgPath = '../images/256x256/256_13.png'
                        else
                            imgPath = '../images/256x256/256_12.png'
                    }       

                    let url = "{{ route('userProfile.show', ':id') }}";
                    url = url.replace(':id', personId);

                    console.log(url);
                    persons += `
                        <div class="card-body-box">
                            <div class="card-body-personInfoWrapper">
                                <div class="card-body-image">
                                    <img src="${imgPath}" alt="User Image">
                                </div>
                                <div class="card-body-presonInfoBox">
                                    <div class="card-body-title">
                                        ${personName}
                                    </div>
                                    <div class="card-body-decr">
                                        ${membersSince}
                                    </div>
                                </div>
                            </div>
                            <div class="card-body-tools">
                                <form method="GET" action="${url}"
                                @csrf
                                    <button>
                                        <i class="fas fa-address-card"></i>
                                    </button>
                                </form>
                            </div>
                        </div>`
                }

                const personListHTML = `
                    <div class="card draggable" draggable="true" id="${elementID}">
                        <div class="card-header">
                            <div class="card-title">GROUP MEMBER LIST</div>
                            <div class="card-tools"> 
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" id="removeBtn${elementID}" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            ${persons}
                        </div>
                    </div>
                `

                return personListHTML;
            }



            //ELEMENT CREATE
        
            //color picker create First chart graph's Background color
            $('#testChartBgColor').colorpicker(
                {
                    options: {
                        namesAsValues: true,
                        autoInputFallback : true
                    }
                }
            );

            //color picker create First chart graph's Border color
            $('#testChartLineColor').colorpicker(
                {
                    options: {
                        namesAsValues: true,
                        autoInputFallback : true
                    }
                }
            );
            
            //color picker create First chart graph's hover background color
            $('#firstBoxHoverBackgroundColor').colorpicker(
                {
                    options: {
                        namesAsValues: true,
                        autoInputFallback : true
                    }
                }
            );

            //color picker create Second chart graph's hover background color
            $('#secondBoxHoverBackgroundColor').colorpicker(
                {
                    options: {
                        namesAsValues: true,
                        autoInputFallback : true
                    }
                }
            );


            //color picker create Secound chart graph's Background color
            $('#testChartSecondBgColor').colorpicker(
                {
                    options: {
                        namesAsValues: true,
                        autoInputFallback : true
                    }
                }
            );

            //color picker create Secound chart graph's Border color
            $('#testChartSecondLineColor').colorpicker(
                {
                    options: {
                        namesAsValues: true,
                        autoInputFallback : true
                    }
                }
            );


            //EVENT LISTENERS

            $('#testChartBgColor').on('colorpickerChange', function(event) {
                testChart.data.datasets[0].backgroundColor = event.color.toString();
                testChart.update();
            });

            $('#testChartLineColor').on('colorpickerChange', function(event) {
                testChart.data.datasets[0].borderColor = event.color.toString();
                testChart.update();
            });

            $('#testChartSecondBgColor').on('colorpickerChange', function(event) {
                testChart.data.datasets[1].backgroundColor = event.color.toString();
                testChart.update();
            });

            $('#testChartSecondLineColor').on('colorpickerChange', function(event) {
                testChart.data.datasets[1].borderColor = event.color.toString();
                testChart.update();
            });

            $('#firstBoxHoverBackgroundColor').on('colorpickerChange', function(event) {
                testChart.data.datasets[0].hoverBackgroundColor = event.color.toString();
                testChart.data.datasets[0].hoverBorderColor = event.color.toString();
                testChart.update();
            });

            $('#secondBoxHoverBackgroundColor').on('colorpickerChange', function(event) {
                testChart.data.datasets[1].hoverBackgroundColor = event.color.toString();
                testChart.data.datasets[1].hoverBorderColor = event.color.toString();
                testChart.update();
            });

            function hideRightSlideBox(){
                const slideBox = document.getElementById('setingsSlideBox');
                slideBox.style.width = '0'

                const slideBoxBtn = document.querySelector('#settingsShowBtn i');
                slideBoxBtn.classList.remove('fa-chevron-right');
                slideBoxBtn.classList.add('fa-chevron-left');

            }

            $('#settingsBtn').click( function(){
                hideRightSlideBox();
                const itemType = $("#itemType").val();

                if('chart' == itemType){
                    hideAllModalElements();
                    $('#ResponseTimeAddWrapper').css('display','block');
                    $('#createNewChart').css('display','block');
                }else if('lastChecks' == itemType){
                    hideAllModalElements();
                    if(dashboardElementCounter.currentStatusChart > 0){
                        $('#newElementAddWarning').css('display','flex');
                    }else{
                        $('#createNewLastStatusBtn').css('display','block');
                    }
                }else if('groupMemberList' == itemType){
                    hideAllModalElements();
                    if(dashboardElementCounter.groupMembersList > 0){
                        $('#newElementAddWarning').css('display','flex');
                    }else{
                        $('#createNewGroupMemberElement').css('display','block');
                    }
                }else{
                    hideAllModalElements();
                }
                $('#settingsModal').show();
            });

            $('#modalCloseBtn').click( function(){
                $('#settingsModal').hide();
            });

            $('#modalCloseTopBtn').click( function(){
                $('#settingsModal').hide();
            });

            $('#savePosition').click( function(){
                $('#saveInProcess').css("display", "block");
                $('#savePosition').addClass('d-none');
                saveDashboardElamentsPositions();
            });

            $('#createNewChart').click( function(){
                const itemTypes = ['responseTimeCheckbox', 'downloadSpeedCheckbox'];
                const responseTimeIsChecked = $('#'+itemTypes[0]).is(':checked');
                const downloadTimeIsChecked = $('#'+itemTypes[1]).is(':checked');
                const hostId = $('#monitor option:selected').val();
                let selectedItem = [];
                let selectedItemType = [];

                let i = 0;
                //Get all zabbix host's items that had been selected
                for(const key in monitorItems){
                    const itemHostId = monitorItems[key].host;
                    const itemType = monitorItems[key].check_type_name;
                    
                    if(itemHostId == hostId){
                        if(itemType == 'Response speed'){
                            if(responseTimeIsChecked){
                                selectedItem[i] = {};
                                selectedItem[i].item_id = monitorItems[key].item_id;
                                selectedItem[i].chart_type = $("input[name='firstChartType_options']:checked").val();
                                selectedItem[i].measurementUnit = $("#responseTimeMeasurementUnit").val();;

                                selectedItemType[i] = 'ResponseTime';
                                i++;
                            }
                        }else if(itemType == 'Download speed'){
                            if(downloadTimeIsChecked){
                                selectedItem[i] = {};
                                selectedItem[i].item_id = monitorItems[key].item_id;
                                selectedItem[i].chart_type = $("input[name='secondChartType_options']:checked").val();
                                selectedItem[i].measurementUnit = $("#downloadSpeedMeasurementUnit").val();

                                selectedItemType[i] = 'DownloadSpeed';
                                i++;
                            }
                        }
                    }
                }

                let itemStyle = [];
                for(const key in selectedItemType){
                    const itemType = selectedItemType[key];

                    if(itemType == 'ResponseTime'){
                        itemStyle[key] = 
                            {
                                'background_color' : $('#BGColor1').val(),
                                'hover_background_color' : $('#hoverBGColor1').val(),
                                'border_color' : $('#BorderColor1').val(),
                                'border_width' : firstHoverSlider.value
                            }
                    }else{
                        itemStyle[key] = 
                            {
                                'background_color' : $('#BGColor2').val(),
                                'hover_background_color' : $('#hoverBGColor2').val(),
                                'border_color' : $('#BorderColor2').val(),
                                'border_width' : secondHoverSlider.value
                            }
                    }

                }

                const monitorName = $('#chartHeader').val()

                createNewChartItem(selectedItem, itemStyle, monitorName);
                $('#settingsModal').hide();
            });

            $('#createNewLastStatusBtn').click( function(){
                createNewLastStatusCheck();
                $('#settingsModal').hide();
            });

            $('#createNewGroupMemberElement').click( function(){
                createGroupMemberItem();
                $('#settingsModal').hide();
            });
            
            function hideAllModalElements(){
                $('#createNewLastStatusBtn').css('display','none');
                $('#ResponseTimeAddWrapper').css('display','none');
                $('#createNewChart').css('display','none');
                $('#createNewGroupMemberElement').css('display','none');
                $('#newElementAddWarning').css('display','none');
            }

            $('#itemType').change( function(){
                const itemType = $("select option:selected").val();

                if('chart' == itemType){
                    hideAllModalElements();
                    $('#ResponseTimeAddWrapper').css('display','block');
                    $('#createNewChart').css('display','block');
                }else if('lastChecks' == itemType){
                    hideAllModalElements();
                    if(dashboardElementCounter.currentStatusChart > 0){
                        $('#newElementAddWarning').css('display','flex');
                    }else{
                        $('#createNewLastStatusBtn').css('display','block');
                    }
                }else if('groupMemberList' == itemType){
                    hideAllModalElements();
                    if(dashboardElementCounter.groupMembersList > 0){
                        $('#newElementAddWarning').css('display','flex');
                    }else{
                        $('#createNewGroupMemberElement').css('display','block');
                    }
                }else{
                    hideAllModalElements();
                }
            });

            function getSMTH(newData, dateFormat){

                if(newData['histories'] != null && newData['histories'].length > 1){
                    let values = [];
                    let clock = [];
                    let currentValue = 0;
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
                        'dataType' : newData['dataType'],
                        'container' : newData['container']
                    };
                    
                    return newHystory;
                } else{
                    return null;
                }
            }


            function costumizeDataForChart(newData){

                let itemCounter = 0;
                let itemColor = [];
                let itemLabels = [];
                let datalabel = [];
                let itemValues = [];

                for(const item in newData.items){
                    const history = newData.items[item].history;
                    if(itemCounter < 1){
                        itemLabels = timestampToHumanDate(history, "DD/MM/YY HH:mm");
                    }

                    const itemType = newData.items[item].checkType;
                    const dataUnit = newData.items[item].symbol;

                    if(itemType == 1){
                        itemValues[itemCounter] = costomizeValues(history, dataUnit);
                    }else{
                        itemValues[itemCounter] = costomizeValues(history, dataUnit);
                    }

                    itemCounter++;
                } 

                return [itemLabels, itemValues];
            }

            function costomizeValues(data, unit){

                const unitOfMesure = {
                    's': 1,
                    'ms': 1000,
                    'MBps': 1000000,
                    'KBps': 1000
                };

                if(unit == 's' || unit == 'ms'){
                    for(let i=0; i<data.length; i++){
                        data[i] = Math.round((data[i].value * unitOfMesure[unit]) * Math.pow(10, 2)) / Math.pow(10, 2);
                    }
                }else{
                    for(let i=0; i<data.length; i++){
                        data[i] = Math.round((data[i].value / unitOfMesure[unit]) * Math.pow(10, 2)) / Math.pow(10, 2);
                    }
                }

                return data;
            }


            function createNewChartItem(items, itemStyle, monitorName){
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
                items: items,
                item_style: itemStyle,
                elementName: monitorName,
                createdElementPosition: lastElementPosition
                }


                })
                .done(function(data) {
                    const chartData = data.newChart;
                    const newData = costumizeDataForChart(chartData);
                    addNewChart(newData, chartData);

                    const elementId = chartData.elementId;
                    //Make element dragable
                    let draggables = [];
                    draggables[0] = document.getElementById(`${elementId}`);
                    addDragDropEvent(draggables);
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
                    const currentValues = data['currentStatus'];
                    const elementId = data['currentStatus']['id'];

                    const elementHTML = getLastChecksChartHTML(currentValues,elementId);

                    insertNewElementIntoContainer(elementContainers[0],elementHTML);
                    setNewPieChart(elementId);

                    const removeBtnId = `removeBtn${elementId}`;
                    addRemoveEventToButton(elementId, removeBtnId);

                    //Make element dragable
                    let draggables = [];
                    draggables[0] = document.getElementById(`${elementId}`);
                    addDragDropEvent(draggables);
                    dashboardElementCounter.currentStatusChart++;

                    toastr.success( @json( __('New item was created successfully!')  ));
                })
                .fail(function() {
                    toastr.error( @json( __('Something whent wrong!')  ));
                });
            }

            function createGroupMemberItem(){
                lastElementPosition++;
                $.ajax( {
                type:'POST',
                header:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ URL::route("user.dashboard.storeGroupMemberElement") }}',
                data:{
                _token: "{{ csrf_token() }}",
                dataType: 'json', 
                contentType:'application/json',
                createdElementPosition: lastElementPosition
                }


                })
                .done(function(data) {
                    const elementId = data[0].id;
                    const groupMemebers = data[0].members;

                    const elementHTML = getPersonListHTML(elementId, groupMemebers);

                    insertNewElementIntoContainer(elementContainers[0],elementHTML);

                    const removeBtnId = `removeBtn${elementId}`;
                    addRemoveEventToButton(elementId, removeBtnId);

                    //Make element dragable
                    let draggables = [];
                    draggables[0] = document.getElementById(`${elementId}`);

                    addDragDropEvent(draggables);
                    dashboardElementCounter.groupMembersList++;

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

                    if(data == 1){
                        dashboardElementCounter.currentStatusChart--;
                    }else if(data == 2){
                        dashboardElementCounter.chart--;
                    }else{
                        dashboardElementCounter.groupMembersList--;
                    }

                    toastr.success( @json( __('Item has been removed!')  ));
                })
                .fail(function() {
                    toastr.error( @json( __('Something whent wrong!')  ));
                });
            }

            function saveDashboardElamentsPositions(){
 
                let allDashboadrElementLeft =  $('#dashboardContent-left').children();
                let allDashboadrElementRight =  $('#dashboardContent-right').children();
                let elementsIds = {
                    leftContainer : [],
                    rightContainer : []
                };

                
                for(let i=0;i<allDashboadrElementLeft.length;i++){
                    elementsIds.leftContainer[i] = allDashboadrElementLeft[i].id;
                }

                for(let i=0;i<allDashboadrElementRight.length;i++){
                    elementsIds.rightContainer[i] = allDashboadrElementRight[i].id;
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
                .done(function() {
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
    });
    </script>
@stop
