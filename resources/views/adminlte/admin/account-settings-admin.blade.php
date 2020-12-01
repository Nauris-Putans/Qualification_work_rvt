@extends('adminlte::page')
@section('title', 'Account Settings')

@section('content_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page"><a>{{ __('Account Settings') }}</a></li>
        </ol>
    </nav>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-12">
            <div class="card" style="background-color: #fd7e14">
                <div class="card-body text-center">
                    <img src="{{ URL::asset('images/256x256/256_1.png') }}" class="mb-2" style="border-radius: 50%; border: 5px solid white;" height="70%" width="70%" alt="Profile_pic">
                    <h3 class="m-3 text-white">Upload a New Photo</h3>
                    <button class="btn btn-light">Update Profile Photo</button>
                </div>
            </div>
        </div>
        <div class="col-lg-9 col-md-9 col-sm-12">
            <div class="card card-orange card-tabs">
                <div class="card-header p-0 pt-1">
                    <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="custom-tabs-one-personal-info-tab" data-toggle="pill" href="#custom-tabs-one-personal-info" role="tab" aria-controls="custom-tabs-one-personal-info" aria-selected="true">
                                Personal Info
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-one-notification-tab" data-toggle="pill" href="#custom-tabs-one-notification" role="tab" aria-controls="custom-tabs-one-notification" aria-selected="false">
                                Notification
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-one-subcription-plan-tab" data-toggle="pill" href="#custom-tabs-one-subcription-plan" role="tab" aria-controls="custom-tabs-one-subcription-plan" aria-selected="false">
                                Subcription Plan
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-one-password-and-security-tab" data-toggle="pill" href="#custom-tabs-one-password-and-security" role="tab" aria-controls="custom-tabs-one-password-and-security" aria-selected="false">
                                Password & Security
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="custom-tabs-one-tabContent">
                        <div class="tab-pane fade active show" id="custom-tabs-one-personal-info" role="tabpanel" aria-labelledby="custom-tabs-one-personal-info-tab">
                            {{ Form::component('personalInfoForm', 'components.form.adminlte.admin.personal-info-admin-form', ['countries' => $countries]) }}
                            {{ Form::personalInfoForm() }}
                        </div>
                        <div class="tab-pane fade" id="custom-tabs-one-notification" role="tabpanel" aria-labelledby="custom-tabs-one-notification-tab">
                            Notification
                        </div>
                        <div class="tab-pane fade" id="custom-tabs-one-subcription-plan" role="tabpanel" aria-labelledby="custom-tabs-one-subcription-plan-tab">
                            Subcription Plan
                        </div>
                        <div class="tab-pane fade" id="custom-tabs-one-password-and-security" role="tabpanel" aria-labelledby="custom-tabs-one-password-and-security-tab">
                            Password & Security
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" />
@stop

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/inputmask/4.0.9/jquery.inputmask.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous"></script>

    <script>
        jQuery(document).ready(function(){
            //email mask
            // Inputmask("*{1,20}[.*{1,20}][.*{1,20}][.*{1,20}]@*{1,20}[.*{2,6}]", {
            //     greedy: false,
            //     onBeforePaste: function (pastedValue, opts) {
            //         pastedValue = pastedValue.toLowerCase();
            //         return pastedValue.replace("mailto:", "");
            //     },
            //     definitions: {
            //         '*': {
            //             validator: "[0-9A-Za-z!#$%&'*+/=?^_`{|}~\-]",
            //             casing: "lower"
            //         }
            //     }
            // }).mask(document.querySelectorAll("input#email-address"));


            // Inputmask("(.999){+|1},00", {
            //     positionCaretOnClick: "radixFocus",
            //     radixPoint: ",",
            //     _radixDance: true,
            //     numericInput: true,
            //     placeholder: "0",
            //     definitions: {
            //         "0": {
            //             validator: "[0-9\uFF11-\uFF19]"
            //         }
            //     }
            // }).mask(document.querySelectorAll("input#phonecode"));

            Inputmask("+([9][9][9][9]) 999 99 999").mask(document.querySelectorAll("input#phonecode"));

            Inputmask().mask(document.querySelectorAll("input"));
            jQuery('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
            });

            let countryList = document.getElementById("countryList") //select list with id countryList
            let phoneCode = document.getElementById('phonecode') //span with id phonecode

            console.log(countryList);
            console.log(phoneCode);

            countryList.addEventListener('change', function(){
                $('#phonecode').val(this.options[this.selectedIndex].getAttribute("phonecode"));
                phoneCode.textContent = this.options[this.selectedIndex].getAttribute("phonecode");
            });
        });
    </script>
@stop
