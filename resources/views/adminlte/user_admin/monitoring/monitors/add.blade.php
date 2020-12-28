@extends('adminlte::page')
@section('title', 'Add')

@section('content_header')
    <h1>Monitoring > Monitors > Add</h1>
@stop

@section('content')
@error('checkField') is-invalid @enderror
    <section class="add-monitor">
        <div class="column">
        <form method="POST" action="{{route('add.store')}}">
            {{-- ,['post' =>$customHeaderCount ?? "sanaca"] --}}
            @csrf

                <div class="row justify-content-around">
                    {{-- 
                        Created by: Rolands Bidzans 
                        Decr: Basic settings
                    --}}
                    <div class="col-md-5 offset-md-1">
                        <div class="add-monitor__items-wrapper">

                            <div class="header">
                                <div class="header__title">Basic Settings</div>
                                <div class="header__line"></div>
                            </div>

                            <div class="item-title" name="kk" id="kk1">Check type</div>
                            <div class="settings-wrapper">
                                <div class="box">
                                    <select type="checkType" name="checkType" id='checkType'>
                                        <option >HTTP/HTTPS</option>
                                        <option >Web socket</option>
                                        <option >ICMP ping</option>
                                        <option >DNS</option>
                                    </select>
                                </div>
                            </div>

                            <div class="settings-wrapper">
                                <div id="checkTypeWripper">
                                    
                                    <div class="item-title">Check URL<span>*</span></div>
                                    <input class="input-large @error('checkField') is-invalid @enderror" type="text" id="URL" name="checkField" placeholder="https://">
                                </div>
                            </div>
                            
                            
                            <div class="item-title">Friendly check name</div>
                            <input class="input-large" type="text" id="friendlyName" name="friendlyName" placeholder="Check name">
                            
                            <div class="item-title">Check interval</div>
                            <div class="settings-wrapper">
                                <div class="settings-wrapper__settings-decr">
                                    Monitor your website every
                                </div>
                                <div class="slidecontainer slidecontainer_interval">
                                    <input type="range" min="10" max="60" value="10" step="5" class="slider" id="myRange" name="intervalSlider">
                                </div>
                                <p><span id="demo"></span> Min(s)</p>
                            </div>
                        </div>
                    </div>


                    {{-- 
                        Created: Rolands Bidzans 
                        Decr: Advanced monitoring settings
                    --}}
                    <div class="col-md-5">
                        <div id='advancedSectionWrapper' class="add-monitor__items-wrapper">
                            <div class="header">
                                <div class="header__title">Advanced monitoring settings</div>
                                <div class="header__line"></div>
                            </div>
                            <div class="item-title">Apdex Response Threshold</div>
                            <div class="settings-wrapper">
                                <div class="settings-wrapper__settings-decr">
                                    Set a response time threshold to calculate the Apdex score
                                </div>
                            </div>
                            <div class="settings-wrapper">
                                <div class="slidecontainer slidecontainer_apdex">
                                    <input type="range" min="1000" max="5000" value="1000" step="500" class="slider" id="myRangeApdex" name="apdexSlider">
                                </div>
                                <p><span id="sliderValueBox"></span> ms</p>
                            </div>
                            <div class="item-title">AUTHENTICATION PARAMETERS</div>
                            <div class="settings-wrapper">
                                <div class="settings-wrapper__settings-decr">
                                    Add credentials to get through authentication and perform the check.
                                </div>
                            </div>
                            <div class="settings-wrapper">
                                <input class="input-small" type="text" id="authenticationName" name="authenticationName" placeholder="User name">
                                <input class="input-small input-small_magin30px" type="text" id="authenticationPassword" name="authenticationPassword" placeholder="Password">
                            </div>

                            <div class="item-title">CUSTOM HTTP HEADER</div>
                            <div class="settings-wrapper">
                                <div class="settings-wrapper__settings-decr">
                                    Add custom header parameters and key
                                </div>
                            </div>
                            <div id="headerSettingsWripper" class="settings-wrapper">
                                <input class="input-small" type="text" id="customHeader" name="Headers[0][Header]" placeholder="Header">
                                <input class="input-small input-small_margin30px" type="text" id="customKey" name="Headers[0][Key]" placeholder="Key">
                            </div>
                            <div id="newHeaders">
                            </div>
                            <a id="addCustomHeader">+ Add custom header</a>
                        </div>
                    </div>


                    {{-- 
                        Created: Rolands Bidzans 
                        Decr: Alert settings
                    --}}
                    <div class="col-md-5 offset-md-1">
                        <div class="add-monitor__items-wrapper">
                            <div class="header">
                                <div class="header__title">Alert settings</div>
                                <div class="header__line"></div>
                            </div>

                            <div class="settings-wrapper">
                                <div class="settings-wrapper__settings-decr">
                                    Do you want to recive alertings?
                                </div>
                                {{-- Toggle switch --}}
                                <div class="toggle-switch-container">
                                    <label class="toggle-switch">
                                    <input class="input" type="checkbox" name="alertCheckbox" checked>
                                        <span class="toggle-slider round"></span>
                                    </label>
                                </div>
                                <a id="alertSettingsLink" href="/settings" target="_self">Change alerting settings</a>
                            </div>
                            
                            <div class="item-title">Who to alert?</div>
                            <div class="settings-wrapper" id="newPersonAddedWrapper">
                                {{-- Auto generate content(Persons to alert) --}}
                            </div>
                            <a id="addPersonToAlert" data-toggle="modal" data-target=".bd-example-modal-sm">+Add another person to alert</a>
                            <div class="item-title">Add note to alert</div>
                            <input class="input-large" type="text" id="troubleshootingInstructions" name="troubleshootingInstructions" placeholder="Troubleshooting instructions">
                        </div>
                    </div>


                    {{-- 
                        Created: Rolands Bidzans 
                        Decr: SSL monitoring settings
                    --}}
                    <div class="col-md-5">
                        <div class="add-monitor__items-wrapper">
                            <div class="header">
                                <div class="header__title">SSL monitoring settings</div>
                                <div class="header__line"></div>
                            </div>

                            <div class="item-title">SSL monitoring</div>
                            <div class="settings-wrapper">
                                <div class="settings-wrapper__settings-decr">
                                    Considers the website as down, if the SSL check fails
                                </div>
                            </div>

                            <div class="item-title">SSL expiry alert</div>
                            <div class="settings-wrapper">
                                <div class="settings-wrapper__settings-decr">
                                    Alerts before SSL certificate expiry
                                </div>
                            </div>
                            <div class="settings-wrapper">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1" checked>
                                    <label class="form-check-label" for="exampleCheck1">Before 7 days</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck2">
                                    <label class="form-check-label" for="exampleCheck2">Before 15 days                                    </label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck3">
                                    <label class="form-check-label" for="exampleCheck3">Before 30 days                                    </label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck4">
                                    <label class="form-check-label" for="exampleCheck4">On expiry</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <button type="submit" class="add-monitor__btn-add" id="storeAllBtn">Add monitor</button>
            </form>
        </div>

        {{-- Modal window for adding new person to alert --}}
        <div class="modal fade bd-example-modal-sm" id="addNewPersonToAlertModal"  tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content">
                    <div class="newPersonTitle">New Person</div>
                    <div class="modalSeperatorline"></div>
                    <div id="addNewPersonErrorsShow"></div>
                    <div class="modal-form-wrapper">
                        <label class="ModalLable" for="personName">Person name</label>
                        <input class="modal-input-form" type="text" id="personName" name="personName[]" placeholder="Example Jurijs">
                        <label class="ModalLable" for="personEmail">Person email</label>
                        <input class="modal-input-form" type="text" id="personEmail" name="personEmail[]" placeholder="Example@webcheck.lv">
                        <label class="ModalLable" for="personNumber">Person number</label>
                        <input class="modal-input-form" type="text" id="personNumber" name="personNumber[]" placeholder="+371 23***343">
                    </div>
                    <div class="modalSeperatorline"></div>
                    <button class="btnNewPersonAdd" id="btnNewPersonAdd">Add</button>
                </div>
            </div>
        </div>

    

    </section>
@stop
@section('css')
    <link rel="stylesheet" href="/css/app.css">
@stop

@section('js')
    <script>
    $(function(){
        
        //Script for Horicontal slider in Check Interval section
        var slider = document.getElementById("myRange");
        var output = document.getElementById("demo");
        output.innerHTML = slider.value;

        slider.oninput = function() {
            output.innerHTML = this.value;
        }

        slider.addEventListener('mousemove', function(){
            let x = this.value-this.min;
            let valueInPercent = (100*x/(this.max-this.min));
            let color = 'linear-gradient(90deg, #CA6D00 '+valueInPercent+'%, rgb(214,214,214) '+valueInPercent+'%)';
            this.style.background = color;
        });

        //Script for Horicontal slider in Apdex response Treshold section
        var sliderApdex = document.getElementById("myRangeApdex");
        var outputApdex = document.getElementById("sliderValueBox");
        outputApdex.innerHTML = sliderApdex.value;

        sliderApdex.oninput = function() {
            outputApdex.innerHTML = this.value;
        }

        sliderApdex.addEventListener('mousemove', function(){
            let x = this.value-this.min;
            let valueInPercent = (100*x/(this.max-this.min));
            let color = 'linear-gradient(90deg, #CA6D00 '+valueInPercent+'%, rgb(214,214,214) '+valueInPercent+'%)';
            this.style.background = color;
        });


        //Created by Rolands Bidzans
        //SCRIPT FOR ADDING NEW CUSTOM HTTP HEADER ELEMENTS

        //VARIABLES
        const addCustomHeaderLink = document.getElementById("addCustomHeader");
        const customheaderSettingsWripper = document.getElementById("advancedSectionWrapper");
        const a = document.getElementById("newHeaders");
        let customHeaderCount = 2;

        //FUNCTION
        function addNewHeader(){
            let createdHeaders=null;
            let newHeaderItem = "";
            for(let i=2;i<=customHeaderCount;i++) {
                createdHeaders = document.getElementById("customHeader"+i);
                if(createdHeaders == null) {
                    newHeaderItem =`
                            <div class="settings-wrapper" id="newHeaderWripper${i}">
                                <input class="input-small" type="text" id="customHeader${i}" name="Headers[${i}][Header]" placeholder="Header${i}">
                                <input class="input-small input-small_margin30px" type="text" id="customKey${i}" name="Headers[${i}][Key]" placeholder="Key${i}">
                                <i class="fas fa-trash invisible" id="headerDelete${i}"></i>
                            </div>
                        `;

                        const position = "beforeend";
                        a.insertAdjacentHTML(position,newHeaderItem);

                        let deleteHeaderIcon = document.getElementById(`headerDelete${i}`);
                        deleteHeaderIcon.addEventListener('click',function(){
                            deleteHeaderIcon.parentNode.parentNode.removeChild(deleteHeaderIcon.parentNode);
                            customHeaderCount--;
                        });

                        let newHeaderWripper = document.getElementById(`newHeaderWripper${i}`);
                        newHeaderWripper.addEventListener('mouseover',function(){
                            deleteHeaderIcon.classList.remove("invisible");
                        });
                        newHeaderWripper.addEventListener('mouseout',function(){
                            deleteHeaderIcon.classList.add("invisible");
                        });

                        customHeaderCount++;
                        break;
                }
            }
        }

        addCustomHeaderLink.addEventListener('click', function(){
            if(customHeaderCount<6){
                addNewHeader();
            }
        });



        //Created by Rolands Bidzans
        //SCRIPT FOR ADDING NEW PERSON TO ALERT

        //VARIABLES
        let newPersonAddedWrapper = document.getElementById("newPersonAddedWrapper");
        let addNewPersonBtn = document.getElementById("btnNewPersonAdd");
        let newPersonName = document.getElementById("personName");
        let newPersonEmail = document.getElementById("personEmail");
        let newPersonNumber = document.getElementById("personNumber");
        let AlertBoxColorLIST = ["gray","orange","#0074D9","#85144b","#DDDDDD","#FF4136","#2ECC40","#F012BF","#3D9970"];
        let PersonsToAlertLIST = [];
        let newPersonCount = 0;
        
        //FUNCTION

        //Check that all forms is filled correct
        function addNewPersonErrorsTests(){
            let testSuccess = false;
            if(newPersonName.value.length<1){
                $("#addNewPersonErrorsShow").html("Person name form should be filled!");
            }else if(newPersonEmail.value.length>=1){
                if(newPersonEmail.value.indexOf("@")==-1){
                    $("#addNewPersonErrorsShow").html("Email should have '@' simbol!");
                }else{
                    testSuccess = true;
                }
            }else if(newPersonNumber.value.length>=1){
                testSuccess = true;
            }else{
                $("#addNewPersonErrorsShow").html("At least Phone or Email form should be field!");
            }

            return testSuccess;
        }

        //Function that add new person from add new person Modal Window if addNewPersonErrorsTests() returns true
        function addNewPersonToAlert(){
            
            let createdPersons=null;
            let newPersonItem = "";

            if(addNewPersonErrorsTests() == true){
                for(let i=0;i<=newPersonCount;i++) {
                    createdPersons = document.getElementById("personToAlert"+i);
                    if(createdPersons == null) {
                        //ADD NEW PERSON 
                        newPersonItem =`
                                        <div class="userWripper" style="background-color : ${AlertBoxColorLIST[i % 10]}" data-toggle="popover${i}" data-trigger="hover" data-placement="top" >
                                            <div class="userWripper__userType" id="personToAlert${i}">U</div>
                                            ${newPersonName.value.substring(0,3)}
                                            <div class="userWripper__delete" id="deletePerson${i}">x</div>
                                        </div>

                                        <input id="PersonName${i}" type="hidden" name="Persons[${i}][Name]" value="${newPersonName.value}">
                                        <input id="PersonNumber${i}" type="hidden" name="Persons[${i}][Number]" value="${newPersonNumber.value}">
                                        <input id="PersonEmail${i}" type="hidden" name="Persons[${i}][Email]" value="${newPersonEmail.value}">
                                    `;
                        const position = "beforeend";

                        newPersonAddedWrapper.insertAdjacentHTML(position,newPersonItem);
                        $(`[data-toggle="popover${i}"]`).popover({
                            title: `${newPersonName.value}` ,
                            content: `Email: ${newPersonEmail.value}<br />Phone number: ${newPersonNumber.value} `,
                            html: true
                        });

                        //SAVE NEW ADDED PERSON'S INFO IN LIST(array)
                        PersonsToAlertLIST.push({
                            id : "personToAlert"+i,
                            name : newPersonName.value,
                            email : newPersonEmail.value,
                            number :  newPersonNumber.value
                        });

                        //ADD EVENTLISTENER TO Delete icon (Delete person)
                        let DeletePersonX = document.getElementById(`deletePerson${i}`);
                        DeletePersonX.addEventListener('click',function(){
                            $(`[data-toggle="popover${i}"]`).popover('hide')
                            DeletePersonX.parentNode.parentNode.removeChild(DeletePersonX.parentNode);
                            $(`#PersonName${i}`).remove();
                            $(`#PersonEmail${i}`).remove();
                            $(`#PersonNumber${i}`).remove();
                            newPersonCount--;

                            //DELETE Person from LIST
                            for(let a=0; a<PersonsToAlertLIST.length;a++){
                                if(PersonsToAlertLIST[a].id == "personToAlert"+i){
                                    PersonsToAlertLIST.splice(a,1);
                                    a=0;
                                    break;
                                }
                            }
                        });

                        //CLEAR MODAL Window FORMS AND HIDE MODAL Window
                        newPersonName.value="";
                        newPersonEmail.value="";
                        newPersonNumber.value="";
                        $("#addNewPersonErrorsShow").html("");
                        $('#addNewPersonToAlertModal').modal('hide');

                        // $('#allPersons').val(PersonsToAlertLIST);
                        newPersonCount++;
                        break;
                    }
                }
            }
            
        }

        addNewPersonBtn.addEventListener("click",addNewPersonToAlert);

        //Check type change
        let checkTypeList = ["HTTP/HTTPS","Web socket","ICMP ping","DNS"];
        let checkType;


        
        $("#checkType").change(function() {
            if(this.value == checkTypeList[0]){
                checkType = `<div class="item-title">Check URL<span>*</span></div>
                        <input class="input-large" type="text" id="URL" name="checkField" placeholder="https://">
                        `
            }else if(this.value == checkTypeList[1]){
                checkType = `<div class="item-title">WS or WSS URL<span>*</span></div>
                        <input class="input-large" type="text" id="WsURL" name="checkField" placeholder="ws://yourdomain.com/sockets/notifications/">
                        `
            }else if(this.value == checkTypeList[2]){
                checkType = `<div class="item-title">IP Address/ Host Name<span>*</span></div>
                        <input class="input-large" type="text" id="IpAddres" name="checkField" placeholder="93.184.216.34 or your yourdomain.com">
                        `
            }else{
                checkType = `<div class="item-title">Host name<span>*</span></div>
                        <input class="input-large" type="text" id="hostName" name="checkField" placeholder="www.domain.com">
                        `
            }
            $("#checkTypeWripper").html(`${checkType}`);
        });


        //ADD EVENT LISTENER TO CHECK BOX
        for(let i=1;i<=4;i++){
            let checkBoxSSL = document.getElementById(`exampleCheck${i}`);
            checkBoxSSL.addEventListener('click',function(){
                for(let a=1;a<=4;a++){
                    if(i!=a){
                        $(`#exampleCheck${a}`).prop("checked", false);
                    }else{
                        $(`#exampleCheck${a}`).prop("checked", true);
                    }
                }
            }); 
        }
    });

    </script>
@stop
