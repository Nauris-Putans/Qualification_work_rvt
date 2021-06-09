@extends('adminlte::page')
@section('title', __('Account Settings'))

@section('content_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page"><a>{{ __('Account Settings') }}</a></li>
        </ol>
    </nav>
@stop

@section('content')
    <x-alertAdmin />

    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-12">
            <div class="card" style="background-color: #fd7e14">
                <div class="card-body text-center">

                    @if(file_exists(public_path() . $user->profile_image) && $user->profile_image != '')
                        <img src="{{ asset(auth()->user()->getUser()->profile_image) }}" id="previewProfileImage" class="mb-2 ProfileImage" alt="profile_pic" style="border-radius: 50%; border: 5px solid white; width: 250px; height: 250px; max-width: 100%;">
                    @else
                        @if($user->gender == 'Male')
                            <img src="{{ asset('images/256x256/256_1.png') }}" id="previewProfileImage" class="mb-2 ProfileImage" alt="profile_pic_default" style="border-radius: 50%; border: 5px solid white; width: 250px; height: 250px; max-width: 100%;">
                        @else
                            <img src="{{ asset('images/256x256/256_12.png') }}" id="previewProfileImage" class="mb-2 ProfileImage" alt="profile_pic_default" style="border-radius: 50%; border: 5px solid white; width: 250px; height: 250px; max-width: 100%;">
                        @endif
                    @endif

                    {{ Form::component('pictureUploadForm', 'components.form.adminlte.user_admin.upload_form', ['countries' => $countries]) }}
                    {{ Form::pictureUploadForm() }}
                </div>
            </div>
        </div>
        <div class="col-lg-9 col-md-9 col-sm-12">
            <div class="card card-orange card-tabs">
                <div class="card-header p-0 pt-1">
                    <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="custom-tabs-one-personal-info-tab" data-toggle="pill" href="#custom-tabs-one-personal-info" role="tab" aria-controls="custom-tabs-one-personal-info" aria-selected="true">
                                {{ __('Personal Info') }}
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-one-subscription-tab" data-toggle="pill" href="#custom-tabs-one-subscription" role="tab" aria-controls="custom-tabs-one-subscription" aria-selected="false">
                                {{ __('Subscription') }}
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-one-notification-tab" data-toggle="pill" href="#custom-tabs-one-notification" role="tab" aria-controls="custom-tabs-one-notification" aria-selected="false">
                                {{ __('Notification') }}
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-one-password-and-security-tab" data-toggle="pill" href="#custom-tabs-one-password-and-security" role="tab" aria-controls="custom-tabs-one-password-and-security" aria-selected="false">
                                {{ __('Password & Security') }}
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-one-alert-notification-tab" data-toggle="pill" href="#custom-tabs-one-alert-notification" role="tab" aria-controls="custom-tabs-one-alert-notification" aria-selected="false">
                                {{ __('Alert notification') }}
                            </a>
                        </li>

                        <!-- Language Dropdown Menu -->
                        <li class="row nav-item dropdown Language" style="margin-right: 0; margin-left: 0;">
                            @if (App::isLocale('en'))
                                <a class="nav-link" data-toggle="dropdown" href="#">
                                    {{ __('Language: ') }}
                                    <span class="ml-2 flag-icon flag-icon-us" style="vertical-align: middle;"></span>
                                </a>
                            @elseif (App::isLocale('lv'))
                                <a class="nav-link" data-toggle="dropdown" href="#">
                                    {{ __('Language: ') }}
                                    <span class="ml-2 flag-icon flag-icon-lv" style="vertical-align: middle;"></span>
                                </a>
                            @elseif (App::isLocale('ru'))
                                <a class="nav-link" data-toggle="dropdown" href="#">
                                    {{ __('Language: ') }}
                                    <span class="ml-2 flag-icon flag-icon-ru" style="vertical-align: middle;"></span>
                                </a>
                            @else
                                <a class="nav-link" data-toggle="dropdown" href="#">
                                    {{ __('Language: ') }}
                                    <span class="ml-2 flag-icon flag-icon-us" style="vertical-align: middle;"></span>
                                </a>
                            @endif

                            {{-- Languages --}}
                            <div class="dropdown-menu dropdown-menu-right p-0">
                                @if (App::isLocale(''))
                                    <a href="lang/en" class="dropdown-item {{ App::isLocale('') ? 'active' : '' }}">
                                        <i class="flag-icon flag-icon-us mr-2"></i> {{ __('English') }}
                                    </a>

                                @else
                                    <a href="lang/en" class="dropdown-item {{ App::isLocale('en') ? 'active' : '' }}">
                                        <i class="flag-icon flag-icon-us mr-2"></i> {{ __('English') }}
                                    </a>
                                @endif

                                <a href="lang/lv" class="dropdown-item {{ App::isLocale('lv') ? 'active' : '' }}">
                                    <i class="flag-icon flag-icon-lv mr-2"></i> {{ __('Latvian') }}
                                </a>

                                <a href="lang/ru" class="dropdown-item {{ App::isLocale('ru') ? 'active' : '' }}">
                                    <i class="flag-icon flag-icon-ru mr-2"></i> {{ __('Russian') }}
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="custom-tabs-one-tabContent">
                        <div class="tab-pane fade active show" id="custom-tabs-one-personal-info" role="tabpanel" aria-labelledby="custom-tabs-one-personal-info-tab">
                            {{ Form::component('personalInfoForm', 'components.form.adminlte.user_admin.personal-info-form', ['countries' => $countries, 'hashids' => $hashids, 'user' => $user, 'countryName' => $countryName]) }}
                            {{ Form::personalInfoForm() }}
                        </div>
                        <div class="tab-pane fade" id="custom-tabs-one-subscription" role="tabpanel" aria-labelledby="custom-tabs-one-subscription-tab">
                            {{ Form::component('subscriptionForm', 'components.form.adminlte.user_admin.subscription-form', ['hashids' => $hashids, 'user' => $user, 'timestamp' => $timestamp, 'planName' => $planName, 'invoices' => $invoices]) }}
                            {{ Form::subscriptionForm() }}
                        </div>
                        <div class="tab-pane fade" id="custom-tabs-one-notification" role="tabpanel" aria-labelledby="custom-tabs-one-notification-tab">
                            {{ Form::component('notificationForm', 'components.form.adminlte.user_admin.notification-form', ['countries' => $countries, 'hashids' => $hashids, 'user' => $user, 'countryName' => $countryName]) }}
                            {{ Form::notificationForm() }}
                        </div>
                        <div class="tab-pane fade" id="custom-tabs-one-password-and-security" role="tabpanel" aria-labelledby="custom-tabs-one-password-and-security-tab">
                            {{ Form::component('passwordSecurityForm', 'components.form.adminlte.user_admin.password-security-form', ['countries' => $countries, 'hashids' => $hashids, 'user' => $user]) }}
                            {{ Form::passwordSecurityForm() }}
                        </div>
                        <div class="tab-pane fade" id="custom-tabs-one-alert-notification" role="tabpanel" aria-labelledby="custom-tabs-one-alert-notification-tab">
                            <div class="col-12 mb-4">
                                <h5>
                                    {{ __('Alerts') }}
                                </h5>
                                <section class="alertNotificationSettings">
                                    <div class="card">
                                        <div class="card-body">
                                            {{-- Week day Options --}}
                                            <div class="flexWrapper">
                                                <div class="options options-spaceAround">
                                                    <button class="alertDay" value="1-5">
                                                        <i class="fas fa-business-time"></i>
                                                        {{ __('Only business day')}}
                                                    </button>
                                                    <button class="alertDay" value="6-7">
                                                        <i class="fas fa-umbrella-beach"></i>
                                                        {{ __('Only weekands')}}
                                                    </button>
                                                </div>
                                                <div class="options options-spaceAround">
                                                    <button class="alertDay alertDay-last" value="1-7">
                                                        <i class="fas fa-satellite"></i>
                                                        {{ __('All week')}}
                                                    </button>
                                                </div>
                                            </div>

                                            {{-- Day time Options --}}
                                            <div class="flexWrapper">
                                                <div class="options" style="justify-content: center">
                                                    <button class="dayTime" value="00:00-06:00">00:00-06:00</button>
                                                    <button class="dayTime" value="00:00-12:00">00:00-12:00</button>
                                                    <button class="dayTime" value="00:00-18:00">00:00-18:00</button>
                                                    <button class="dayTime" value="06:00-12:00">06:00-12:00</button>
                                                    <button class="dayTime" value="06:00-18:00">06:00-18:00</button>
                                                    <button class="dayTime" value="06:00-24:00">06:00-24:00</button>
                                                    <button class="dayTime" value="12:00-18:00">12:00-18:00</button>
                                                    <button class="dayTime" value="12:00-24:00">12:00-24:00</button>
                                                    <button class="dayTime" value="18:00-24:00">18:00-24:00</button>
                                                    <button class="dayTime" value="00:00-24:00">00:00-24:00</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 justify-content-center mt-2 mb-2">
                                        <button type="submit" id="bnt_save_period" class="btn btn-info">
                                            <i class="fas fa-pencil-alt mr-1"></i>
                                            Save Changes
                                        </button>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('css/adminlte.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css" integrity="sha512-ARJR74swou2y0Q2V9k0GbzQ/5vJ2RBSoCWokg4zkfM29Fb3vZEQyv0iWBMW/yvKgyHSR/7D64pFMmU8nYmbRkg==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.1.3/css/fileinput.min.css" integrity="sha512-8KeRJXvPns3KF9uGWdZW18Azo4c1SG8dy2IqiMBq8Il1wdj7EWtR3EGLwj+DnvznrRjn0oyBU+OEwJk7A79n7w==" crossorigin="anonymous" />
    <link href="/css/adminlte/user_admin/alertNotificationSettings.css" rel="stylesheet">
@stop

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/inputmask/4.0.9/jquery.inputmask.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/inputmask-multi/1.2.0/js/jquery.inputmask-multi.min.js" integrity="sha512-uc/k0URVEJ6zKAoRrwd74AENBzCIG7TEeUaTZg76wnjubn22rx/1WTNCeXWbVVUxhKKGHA7XGTtXhhoA2Y4UTQ==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js" integrity="sha512-yDlE7vpGDP7o2eftkCiPZ+yuUyEcaBwoJoIhdXv71KZWugFqEphIS3PU60lEkFaz8RxaVsMpSvQxMBaKVwA5xg==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.1.3/js/fileinput.min.js" integrity="sha512-vDrq7v1F/VUDuBTB+eILVfb9ErriIMW7Dn3JC/HOQLI8ZzTBTRRKrKJO3vfMmZFQpEGVpi+EYJFatPgVFxOKGA==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.lv.min.js" integrity="sha512-EBQ4AKUTMmsHWVOP6ewCQ1ZZ/yQww57J8iSil2dSX2qdRyMyNn/iRdsCVaR7wpVXxcy5UOovDnJ/0FJSxmyZ2w==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.en-GB.min.js" integrity="sha512-r4PTBIGgQtR/xq0SN3wGLfb96k78dj41nrK346r2pKckVWc/M+6ScCPZ9xz0IcTF65lyydFLUbwIAkNLT4T1MA==" crossorigin="anonymous"></script>

    <script>
        jQuery(document).ready(function()
        {
            // Previews uploaded image
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#previewProfileImage').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }

            $("#profile_image").change(function(){
                readURL(this);
            });

            // Selectpicker
            $(function() {
                $('.selectpicker').selectpicker();
            });

            $(".custom-file-input").on("change", function() {
                var fileName = $(this).val().split("\\").pop();
                $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
            });

            // Adds masked input value to unmasket input (hidden input)
            document.getElementById('bnt_save').onclick = function(){
                document.getElementById('customer_phone').value = document.getElementById('phonecode').value;
            };

            $('#phonecode').change(function() {
                $('#customer_phone').val($('#phonecode').val());
            });

            // Adds country phone starting numbers in input
            let countryList = document.getElementById("countryList");
            let phoneCode = document.getElementById('phonecode');

            countryList.addEventListener('change', function(){
                $('#phonecode').val(this.options[this.selectedIndex].getAttribute("phonecode"));
                phoneCode.textContent = this.options[this.selectedIndex].getAttribute("phonecode");
            });

            ///////////////////////// Bootstrap Datepicker /////////////////////////

            // Localize datepicker language = Russian
            $.fn.datepicker.dates['ru'] = {
                days: ["Воскресенье", "Понедельник", "Вторник", "Среда", "Четверг", "Пятница", "Суббота"],
                daysShort: ["Вск", "Пнд", "Втр", "Срд", "Чтв", "Птн", "Суб"],
                daysMin: ["Вс", "Пн", "Вт", "Ср", "Чт", "Пт", "Сб"],
                months: ["Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь"],
                monthsShort: ["Янв", "Фев", "Мар", "Апр", "Май", "Июн", "Июл", "Авг", "Сен", "Окт", "Ноя", "Дек"],
                today: "Сегодня",
                clear: "Очистить",
                format: "dd/mm/yyyy",
                weekStart: 1,
                monthsTitle: "Месяцы"
            };

            // Default format for datepicker
            $.fn.datepicker.defaults.format = "dd/mm/yyyy";

            // Finds projects locale language
            var locale = '<?php echo(Config::get('app.locale'));?>';

            // Datepicker for birthday
            $('.datepicker').datepicker({
                format: 'yyyy/mm/dd',
                language: locale,
            });

            //ALERT SECTION JS SCRIPT//

            //FUNCTIONS

            function setSelectedPeriod(){
                let alertPeriod = <?php echo json_encode($alertPeriod); ?>;
                const alertDays = alertPeriod.substring(0,3);
                const index = alertPeriod.indexOf(",");
                const alertHours = alertPeriod.substring(index+1);

                const alertDayButtons = document.querySelectorAll('.alertDay');
                alertDayButtons.forEach((button) => {
                    if(button.value === alertDays){
                        button.classList.add('selected');
                    }
                });

                const alertHourButtons = document.querySelectorAll('.dayTime');
                alertHourButtons.forEach((button) => {
                    if(button.value === alertHours){
                        button.classList.add('selected');
                    }
                });
            }
            setSelectedPeriod()

            //Removes class selected from all buttons that have specific class
            //specific class is passed like function's atribute
            function removeSelectClassFromAllButtons(buttonClass){        
                const alertDayButtons = document.querySelectorAll(buttonClass);

                alertDayButtons.forEach((button) => {
                    button.classList.remove('selected');
                });
            }    

            //ELVENT LISTENERTS

            //Add event listener to alert day buttons
            const alertDayButtons = document.querySelectorAll('.alertDay');
            alertDayButtons.forEach((button) => {
                button.addEventListener('click', () => {
                    removeSelectClassFromAllButtons('.alertDay'); 
                    button.classList.add('selected');
                });
            });

            //Add event listener to dayTime buttons
            const dayTimeButtons = document.querySelectorAll('.dayTime');
            dayTimeButtons.forEach((button) => {
                button.addEventListener('click', () => {
                    removeSelectClassFromAllButtons('.dayTime'); 
                    button.classList.add('selected');
                });
            });

            //Add event listener to save alert period
            const savePeriodButton = document.getElementById('bnt_save_period');
            savePeriodButton.addEventListener('click', () => {
                const alertDay = document.getElementsByClassName('alertDay selected')[0].value;
                const alertHours = document.getElementsByClassName('dayTime selected')[0].value;

                const alertPeriod = alertDay + ',' + alertHours;

                saveAlertPeriod(alertPeriod)
            })


            //AJAX REXUESTS
            function saveAlertPeriod(alertPeriod){
                $.ajax( {
                    type:'POST',
                    header:{
                    'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ URL::route('user.settings.alert_notification.update') }}",
                    data:{
                    _token: "{{ csrf_token() }}",
                    dataType: 'json', 
                    contentType:'application/json',
                    //My passed data 
                    alertPeriod: alertPeriod,
                    }

                })
                .done(function(data) {
console.log(data);
                })
                .fail(function(error) {
    
                });
            }
        });

        ///////////////////////// Phone Mask using andr-04/inputmask-multi plugin (jQuery) /////////////////////////
        var maskList = $.masksSort($.masksLoad("https://cdn.rawgit.com/andr-04/inputmask-multi/master/data/phone-codes.json"), ['#'], /[0-9]|#/, "mask");
        var maskOpts = {
            inputmask: {
                definitions: {
                    '#': {
                        validator: "[0-9]",
                        cardinality: 1
                    }
                },
                showMaskOnHover: false,
                autoUnmask: true,
                clearMaskOnLostFocus: true

            },
            match: /[0-9]/,
            replace: '#',
            list: maskList,
            listKey: "mask",
            // onMaskChange: function(maskObj, determined) {
            //     if (determined) {
            //         var hint = maskObj.name_en;
            //         if (maskObj.desc_en && maskObj.desc_en != "") {
            //             hint += " (" + maskObj.desc_en + ")";
            //         }
            //         $("#descr").html(hint);
            //     } else {
            //         $("#descr").html("");
            //     }
            // }
        };

        $('#phone_mask').change();
        $('#phone_mask').is(':checked');

        $('#phone_mask').change();
        $('#phone_mask').is(':checked');

        // Phone number without mask
        $('#customer_phone').inputmasks("remove");
        $('#customer_phone').inputmask("+#{*}", maskOpts.inputmask);

        $('#customer_mobile_phone').inputmasks("remove");
        $('#customer_mobile_phone').inputmask("+#{*}", maskOpts.inputmask);

        // Phone number with mask
        $('#phonecode').inputmask("remove");
        $('#phonecode').inputmasks(maskOpts);

        $('#mobile_phonecode').inputmask("remove");
        $('#mobile_phonecode').inputmasks(maskOpts);
    </script>
@stop
