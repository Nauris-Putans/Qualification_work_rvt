@extends('adminlte::page')
@section('title', __('Edit'))

@section('content_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
                <a href="{{ URL::route('admin.user_admin.index') }}" >{{ __('Dashboard')}}</a>
                \
                <a href="{{ URL::route('monitor.list.show') }}" >{{ __('Monitor list')}}</a>
                \
                <a>{{ __('monitor edit')}}</a>
            </li>
        </ol>
    </nav>
@stop

@section('content')
    <section class="monitorAdd">
        <div class="container">
            <div class="row">
                <div class="col-md-12 monitorAddWrapper" id="monitorAddWrapper">

                    {{-- Settings header --}}
                    <div class="monitorAdd-header monitorAdd-header-first-step" id="monitorAddHeader">
                        <div class="currentStepWrapper" >
                            <div class="currentStepBox bg-current-step" id="firstStep">
                                <i class="fas fa-cog"></i>
                            </div>
                        </div>
                        <div class="currentStepWrapper">
                            <div class="currentStepBox" id="secoundStep">
                                <i class="fas fa-file-invoice"></i>
                            </div>
                        </div>
                        <div class="currentStepWrapper">
                            <div class="currentStepBox" id="thirdStep">
                                <i class="fas fa-shield-alt"></i>
                            </div>
                        </div>
                        <div class="currentStepWrapper" >
                            <div class="currentStepBox" id="fourthStep">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                        <div class="currentStepWrapper d-none">
                            <div class="currentStepBox" id="lastStep">
                                <i class="fas fa-clipboard-check"></i>
                            </div>
                        </div>
                    </div>

                    {{-- Settings body --}}
                    <div class="monitorAdd-SettingsWrapper">

                        {{-- Settings title --}}
                        <div class="settings-title" id="settingsTitle">
                            {{ __('Basic settings')}}
                        </div>

                        {{-- Bsic settings --}}
                        <div class="settingsWrapper" id="basicSettingsWrapper">
                            <div class="row justify-content-center">
                                <div class="col-sm-6">
                                    <!-- select -->
                                    <div class="form-group">
                                      <label for="monitorType">{{ __('Check type')}}</label>
                                      <input type="text" class="form-control" id="monitorType" name="monitorType" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="checkAddress" id="checkAddressTitle">{{ __('Check URL')}}</label>
                                        <input type="text" class="form-control" value="{{$monitor->user_input}}" id="checkAddress" name="checkAddress" placeholder="https://" disabled>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="friendlyName">{{ __('Friendly name')}}</label>
                                        <input type="text" class="form-control" value="{{$monitor->friendly_name}}" id="friendlyName" name="friendlyName" placeholder="Friendly moitor name">
                                      </div>
                                </div>
                            </div>
                            <div class="row justify-content-center" style="padding-bottom: 20px">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="sliderInfoWrapper">
                                            <label for="checkInterval">{{ __('Check interval')}}</label>
                                            <div class="sliderValue" id="intervalSliderValue"></div>
                                        </div>
                                        <div class="slidecontainer slidecontainer_interval">
                                            <input type="range" min="0" max="10" value="0" step="1" class="slider" id="checkInterval" name="checkInterval">
                                        </div>
                                      </div>
                                </div>
                            </div>
                            <div class="monitorAdd-footer">
                                {{-- Start step buttons --}}
                                <button id="nextToAddUsersStep" class="rightBtn">{{ __('Next')}}<i class="fas fa-long-arrow-alt-right"></i></button>
        
                            </div>
                        </div>

                        {{-- Add who to alert settings --}}
                        <div class="settingsWrapper displayNone" id="addUsersSettingsWrapper">
                            <div class="row justify-content-center" style="margin-top: 20px">
                                <div class="col-md-6 ">
                                        <div class="ssl_title">{{ __('Apdex Response Threshold')}}</div>
                                        <div class="ssl_decr ">{{ __('Set a response time threshold to calculate the Apdex score')}}</div>
                                        <div class="form-group" style="margin-top:10px">
                                            <div class="slidecontainer slidecontainer_interval">
                                                <input disabled type="range" min="10" max="60" value="10" step="5" class="slider" id="apdexInterval" name="checkInterval">
                                            </div>
                                        </div>
                                        <div class="ssl_title" style="margin-top: 10px">{{ __('AUTHENTICATION PARAMETERS')}}</div>
                                        <div class="ssl_decr ">{{ __('Add credentials to get through authentication and perform the check.')}}</div>
                                        <div class="row justify-content-center" style="margin-top: 10px">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <input disabled type="text" class="form-control" id="authenticationUsername" name="authenticationUsername" placeholder="User name">
                                                  </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <input disabled type="text" class="form-control" id="authenticationPassword" name="authenticationPassword" placeholder="Password">
                                                  </div>
                                            </div>
                                        </div>

                                        <div class="ssl_title" style="margin-top: 10px">{{ __('CUSTOM HTTP HEADER')}}</div>
                                        <div class="ssl_decr ">{{ __('Add custom header parameters and key')}}</div>
                                        <div class="row justify-content-center" style="margin-top: 10px">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <input disabled type="text" class="form-control" id="header" name="header" placeholder="Header">
                                                  </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <input disabled type="text" class="form-control" id="headerKey" name="headerKey" placeholder="Key">
                                                  </div>
                                            </div>
                                        </div>
                                </div>
                            </div>
                            <div class="monitorAdd-footer">
                                {{-- Buttons in add users step --}}
                                <button id="backToBasicSettings" class="leftBtn"><i class="fas fa-long-arrow-alt-left"></i>{{ __('Previous')}}</button>
                                <button id="nextToAdvancedSettings" class="rightBtn">{{ __('Next')}}<i class="fas fa-long-arrow-alt-right"></i></button>
                            </div>
                        </div>

                        {{-- Advanced settings --}}
                        <div class="settingsWrapper displayNone" id="advancedSettingsWrapper">
                            <div class="row justify-content-center" style="margin-top: 10px">
                                <div class="col-md-6 ">
                                        <div class="ssl_title">{{ __('SSL monitoring')}}</div>
                                        <div class="ssl_decr ">{{ __('Considers the website as down, if the SSL check fails')}}</div>
                                        <div class="ssl_title" style="margin-top: 10px">{{ __('SSL expiry alert')}}</div>
                                        <div class="ssl_decr ">{{ __('Alerts before SSL certificate expiry')}}</div>
                                </div>
                            </div>
                            <div class="row justify-content-center" style="margin-top: 40px">
                                <div class="col-md-6  d-flex">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input checked type="radio" class="custom-control-input" id="noSSLCheck" name="example" value="customEx">
                                        <label class="custom-control-label" for="noSSLCheck">{{ __('No SSL check')}}</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" id="7dayBefore" name="example" value="customEx" disabled>
                                        <label class="custom-control-label" for="7dayBefore">{{ __('Before 7 days')}}</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" id="30dayBefore" name="example" value="customEx" disabled>
                                        <label class="custom-control-label" for="30dayBefore">{{ __('Before 30 days')}}</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" id="onExpiry" name="example" value="customEx" disabled>
                                        <label class="custom-control-label" for="onExpiry">{{ __('On expiry')}}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="monitorAdd-footer">      
                                {{-- Buttons in advanced settings step --}}
                                <button id="backToAddUsersStep" class="leftBtn"><i class="fas fa-long-arrow-alt-left"></i>{{ __('Previous')}}</button>
                                <button id="nextToSSLMonitoringSettings" class="rightBtn">{{ __('Next')}}<i class="fas fa-long-arrow-alt-right"></i></button>
                            </div>
                        </div>

                        {{-- Select user settings --}}
                        <div class="settingsWrapper displayNone" id="SSLSettingsWrapper" >
                            <div class="row justify-content-center">
                                <div class="col-md-5">
                                    <div class="table-responsive-md">
                                        <table class="table table-user">
                                            <thead class="thead-light">
                                                <tr>
                                                <th width="60%">{{ __('User Name')}}</th>
                                                <th width="30%">{{ __('Type')}}</th>
                                                <th width="10%">{{ __('Select')}}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($groupedPersons->reciveAlertPersons as $user)
                                                    <tr>
                                                        <td class="table-user-name">
                                                            @if($user->profile_image)
                                                                <img alt="Avatar" class="table-avatar" src="../../../..{{ $user->profile_image}}">
                                                            @else
                                                                @if($user->gender == 'Female')
                                                                    <img alt="Avatar" class="table-avatar" src="../../../../images/256x256/256_12.png">
                                                                @else
                                                                    <img alt="Avatar" class="table-avatar" src="../../../../images/256x256/256_13.png">
                                                                @endif
                                                            @endif
                                                            {{ $user->name }}
                                                        </td>
                                                        <td style="vertical-align: middle">
                                                            <div class="userPermission">{{ __('Member')}}</div>
                                                        </td>
                                                        <td style="vertical-align: middle" >
                                                            <div class="select-icon-box selected" id="userSelect{{ $user->userID  }}">
                                                                <i class="fas fa-check"></i>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                @foreach ($groupedPersons->noReciveAlertPersons as $user)
                                                    <tr>
                                                        <td class="table-user-name">
                                                            @if($user->profile_image)
                                                                <img alt="Avatar" class="table-avatar" src="../../../..{{ $user->profile_image}}">
                                                            @else
                                                                @if($user->gender == 'Female')
                                                                    <img alt="Avatar" class="table-avatar" src="../../../../images/256x256/256_12.png">
                                                                @else
                                                                    <img alt="Avatar" class="table-avatar" src="../../../../images/256x256/256_13.png">
                                                                @endif
                                                            @endif
                                                            {{ $user->name }}
                                                        </td>
                                                        <td style="vertical-align: middle">
                                                            <div class="userPermission">{{ __('Member')}}</div>
                                                        </td>
                                                        <td style="vertical-align: middle" >
                                                            <div class="select-icon-box" id="userSelect{{ $user->userID  }}">
                                                                <i class="fas fa-plus"></i>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            {{-- Selected users --}}
                            <div class="row justify-content-center" style="margin-top: 10px">
                                <div class="col-md-6 d-flex justify-content-around"> 
                                    <div class="alertLanguage-wrapper" id="englishLanguage">    
                                        <i class="flag-icon flag-icon-us"></i>
                                        <div class="alertLanguage-title">{{ __('English')}}</div>
                                    </div> 
                                    <div class="alertLanguage-wrapper" id="latvianLanguage">    
                                        <i class="flag-icon flag-icon-lv"></i>
                                        <div class="alertLanguage-title">{{ __('Latvian')}}</div>
                                    </div> 
                                    <div class="alertLanguage-wrapper" id="russianLanguage">    
                                        <i class="flag-icon flag-icon-ru"></i>
                                        <div class="alertLanguage-title">{{ __('Russian')}}</div>
                                    </div> 
                                </div>
                            </div>
                            <div class="monitorAdd-footer">      
                                {{-- Select alert persons section button --}}
                                <button id="backSSLSettings"  class="leftBtn"><i class="fas fa-long-arrow-alt-left"></i>{{ __('Previous')}}</button>
                                <button id="createMonitor" class="completeBtn">{{ __('Update')}}<i class="fas fa-clipboard-check"></i></button>
                                <div class="spinerBox" id="spinerBox">
                                    <div class="spinner-border text-primary" role="status">
                                        <span class="visually-hidden"></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Monitor was successful updated --}}
                        <div class="settingsWrapper d-none" id="monitorCreatedWrapper">
                                <div class="success_header"> {{ __('Success')}}</div>
                                <div class="success_decr">{{ __('Monitor has been updated!')}}</div>
                                <div class="icon-box"><i class="fas fa-laugh-wink"></i></div>
                            <div class="monitorAdd-footer">      
                                <form method="GET" action="{{ URL::route('monitor.list.show') }}">
                                    @csrf
                                    <button id="backToStart"  class="toStartBtn">{{ __('Go back to monitor list')}}</button> 
                                </form> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
@section('css')
    <link href="/css/adminlte/user_admin/monitorAdd.css" rel="stylesheet">

    {{-- Toastr styles --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" media="all">
@stop

@section('js')
{{-- toastr --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
{{-- Swal --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.14.0/sweetalert2.min.js"></script>

<script>
    $(function(){

        let checkIntervalSlider = document.getElementById("checkInterval");
        let intervalSliderValue = document.getElementById("intervalSliderValue");

        function setStartIntervalPickerValue(){
            let checkInterval = <?php echo json_encode($monitor->check_interval); ?>;
            intervalSliderValue.innerHTML = checkInterval;

            if(checkInterval == '30s'){
                
            }else{
                checkInterval = checkInterval.replace('m','');
                checkInterval = parseInt(checkInterval);
                checkIntervalSlider.value = checkInterval;
                let x = checkIntervalSlider.value-checkIntervalSlider.min;
                let valueInPercent = (100*x/(checkIntervalSlider.max-checkIntervalSlider.min));
                let color = 'linear-gradient(90deg, #17a2b8 '+valueInPercent+'%, rgb(214,214,214) '+valueInPercent+'%)';
                checkIntervalSlider.style.background = color;
            }

        }

        setStartIntervalPickerValue();
        
        function setCheckedMonitorType(){
            const selectedMonitor = <?php echo json_encode($monitor->monitor_type); ?>;
            const monitortype = ['ICMP ping', 'HTTP/HTTPS', 'DNS'];
            document.getElementById("monitorType").value = monitortype[selectedMonitor-1];
        }
        setCheckedMonitorType();

        function setSelectedAlertLanguage(){
            const selectedLanguage = <?php echo json_encode($alertLanguage); ?>;
            const languageElementIds = {
                'English': 'englishLanguage',
                'Latvian': 'latvianLanguage',
                'Russian': 'russianLanguage',
            };

            if(selectedLanguage){
                const elementId = languageElementIds[selectedLanguage];
                let languageElement = document.getElementById(elementId);
                languageElement.classList.add("selected");
            }else{
                let languageElement = document.getElementById('englishLanguage');
                languageElement.classList.add("selected");
            }

        }
        setSelectedAlertLanguage();

        let usersToAlert = [];

        function setAlertPersons(){
            const persons = <?php echo json_encode($groupedPersons->reciveAlertPersons); ?>;

            for(let i=0; i<persons.length; i++){
                const personID = (persons[i].userID).toString();
                usersToAlert.push(personID);
            }


        }
        setAlertPersons();

        const usersSelectIcon = document.querySelectorAll('.select-icon-box');
        usersSelectIcon.forEach((icon) => {

            icon.addEventListener('click', () => {
                let addUserId = icon.id;
                addUserId = addUserId.replace('userSelect','');
                addUserId = (addUserId).toString()

                const currentIcon = icon.children[0].classList.contains('fa-plus');
                if(currentIcon){
                    icon.children[0].classList.remove('fa-plus');
                    icon.children[0].classList.add('fa-check');
                    icon.classList.add('selected');
                    
                    usersToAlert.push(addUserId);
                }else{
                    icon.children[0].classList.remove('fa-check');
                    icon.children[0].classList.add('fa-plus');
                    icon.classList.remove('selected');

                    let index = usersToAlert.indexOf(addUserId);
                    if (index > -1) {
                        usersToAlert.splice(index, 1);
                    }
                }
            });
        });

        //FUNCTIONS
        function removeSelectedFromLanguages(){
          $('#englishLanguage').removeClass('selected');
          $('#latvianLanguage').removeClass('selected');
          $('#russianLanguage').removeClass('selected');
        }

        //EVENT LISTENERS
        $('#englishLanguage').click( function(){
            removeSelectedFromLanguages()
            $('#englishLanguage').addClass('selected')
        });

        $('#latvianLanguage').click( function(){
            removeSelectedFromLanguages()
            $('#latvianLanguage').addClass('selected')
        });

        $('#russianLanguage').click( function(){
            removeSelectedFromLanguages()
            $('#russianLanguage').addClass('selected')
        });

        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });

        //EVENT LISTENERS

        //Sliders
        checkIntervalSlider.oninput = function() {

            if(this.value > 0){
                intervalSliderValue.innerHTML = this.value + 'm';
            }else{
                intervalSliderValue.innerHTML = '30s';
            }
        }

        checkIntervalSlider.addEventListener('mousemove', function(){
            let x = this.value-this.min;
            let valueInPercent = (100*x/(this.max-this.min));
            let color = 'linear-gradient(90deg, #17a2b8 '+valueInPercent+'%, rgb(214,214,214) '+valueInPercent+'%)';
            this.style.background = color;
        });



        $('#nextToAddUsersStep').click( function(){
            $('#monitorAddHeader').addClass('monitorAdd-header-secound-step');
            $('#secoundStep').addClass('bg-current-step');
            $('#settingsTitle').text('Advanced settings');
            $('#basicSettingsWrapper').css("display", "none");
            $('#addUsersSettingsWrapper').css("display", "block");
        });

        //Add users settings buttons
        $('#backToBasicSettings').click( function(){   
            $('#monitorAddHeader').removeClass('monitorAdd-header-secound-step');
            $('#secoundStep').removeClass('bg-current-step');
            $('#settingsTitle').text('Basic settings');
            $('#basicSettingsWrapper').css("display", "block");
            $('#addUsersSettingsWrapper').css("display", "none");
        });

        $('#nextToAdvancedSettings').click( function(){
            $('#monitorAddHeader').removeClass('monitorAdd-header-secound-step');
            $('#monitorAddHeader').addClass('monitorAdd-header-third-step');
            $('#thirdStep').addClass('bg-current-step');
            $('#settingsTitle').text('SSL certificate');
            $('#addUsersSettingsWrapper').css("display", "none");
            $('#advancedSettingsWrapper').css("display", "block");
        });

        //Advanced settings buttons
        $('#backToAddUsersStep').click( function(){
            $('#monitorAddHeader').removeClass('monitorAdd-header-third-step');
            $('#monitorAddHeader').addClass('monitorAdd-header-secound-step');
            $('#thirdStep').removeClass('bg-current-step');
            $('#settingsTitle').text('Advanced settings');
            $('#advancedSettingsWrapper').css("display", "none");
            $('#addUsersSettingsWrapper').css("display", "block");
        });

        $('#nextToSSLMonitoringSettings').click( function(){  
            $('#monitorAddHeader').addClass('monitorAdd-header-last-step');
            $('#monitorAddHeader').removeClass('monitorAdd-header-third-step');
            $('#fourthStep').addClass('bg-current-step');
            $('#settingsTitle').text('Alert settings');
            $('#SSLSettingsWrapper').css("display", "block");
            $('#advancedSettingsWrapper').css("display", "none");
        });

        // Alert settings section buttons
        $('#backSSLSettings').click( function(){
            $('#monitorAddHeader').removeClass('monitorAdd-header-last-step');
            $('#monitorAddHeader').addClass('monitorAdd-header-third-step');
            $('#fourthStep').removeClass('bg-current-step');
            $('#settingsTitle').text('SSL certificate');
            $('#SSLSettingsWrapper').css("display", "none");
            $('#advancedSettingsWrapper').css("display", "block");
        });

        $('#createMonitor').click( function(){
            $('#createMonitor').css("display", "none");
            $('#backSSLSettings').css("display", "none");
            $('#spinerBox').css("display", "flex");
            addNewMonitor();
        });

        function showMonitorCreatedPage(message){
            $('#monitorCreatedWrapper').removeClass('d-none');
            $('#settingsTitle').addClass('d-none');
            $('#SSLSettingsWrapper').addClass('d-none');
            $('#lastStep').addClass('bg-current-step');

            const stepWrappers = document.querySelectorAll('.currentStepWrapper');
            stepWrappers.forEach((wrapper) => {
                wrapper.classList.toggle('d-none');
            });

            const header = document.getElementById('monitorAddHeader');
            header.style.justifyContent = 'center';

            toastr.success(message);
        }

        //AJAX REQUESTS
        let lastError = [];
        let errorCounter = 0;
        //Add new monitor
        function addNewMonitor(){

            //Remove class 'is-invalid' from all elements
            const arrayLength = lastError.length;
            for (let i = 0; i < arrayLength; i++) {
                if(lastError != ''){
                    $(`#${lastError[i]}`).removeClass('is-invalid');
                }
            }

            lastError = [];

            let friendlyName = $('#friendlyName').val();
            let checkInterval = checkIntervalSlider.value;
            const oldData = <?php echo json_encode($monitor); ?>;
            let email = $('.alertLanguage-wrapper.selected')[0].id;
            email = email.replace('Language','');

            $.ajax( {
            type:'POST',
            header:{
            'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            },
            url:'{{ URL::route("monitor.edit.update") }}',
            data:{
            _token: "{{ csrf_token() }}",
            dataType: 'json', 
            contentType:'application/json',
            //My passed data 
            monitor: oldData,
            friendlyName: friendlyName,
            checkInterval: checkInterval,
            personsToAlert: usersToAlert,
            email: email,
            }


            })
          .done(function(data) {
            $('#createMonitor').css("display", "block");
            $('#backSSLSettings').css("display", "block");
            $('#spinerBox').css("display", "none");

            data = data.original;
            if(data.message){
                showMonitorCreatedPage(data.message)
            }
            else if(data.error){
                toastr.error(data.error);
            }else{
                for (key in data) {
                    show_validation_failed(key, data[key]);
                    moveToFirstValidationFailedPage(key);
                    toastr.error(data[key]);
                }
            }
          })
          .fail(function(error) {
            $('#createMonitor').css("display", "block");
            $('#backSSLSettings').css("display", "block");
            $('#spinerBox').css("display", "none");
            if (error.status == 422) {
                let response = JSON.parse(error.responseText);
                let firstErrorId;
                $.each( response.errors, function( key, value) {
                    toastr.error(value);
                    show_validation_failed(key, value[0]);
                    if(errorCounter == 0){
                        firstErrorId = key;
                    }
                    errorCounter++;
                });
                errorCounter = 0;
                moveToFirstValidationFailedPage(firstErrorId)
            }
          });
        }

        //Show/display where is first error occures
        function moveToFirstValidationFailedPage(firstError_item_id){
            if(firstError_item_id == 'checkAddress' || firstError_item_id == 'friendlyName'){
                $('#settingsTitle').text('Basic settings');
                $('#basicSettingsWrapper').css("display", "block");
                $('#lastStep').removeClass('bg-current-step');
                $('#thirdStep').removeClass('bg-current-step');
                $('#fourthStep').removeClass('bg-current-step');
                $('#secoundStep').removeClass('bg-current-step');
                $('#monitorAddHeader').removeClass('monitorAdd-header-last-step');
            }else{
                alert( @json( __('This element is not validated correctly yet') ));
            }
        }

        function show_validation_failed(error_ītem_id, error_message){
            if(error_ītem_id != 'NotUseId'){
                lastError[errorCounter] = error_ītem_id;
                $(`#${error_ītem_id}`).addClass('is-invalid');
            }
        }
    });
</script>
@stop
