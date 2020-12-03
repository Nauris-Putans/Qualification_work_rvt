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
                    <h3 class="m-3 text-white">{{ __('Upload a New Photo') }}</h3>
                    <button class="btn btn-light">{{ __('Update Profile Photo') }}</button>
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
                            <a class="nav-link" id="custom-tabs-one-notification-tab" data-toggle="pill" href="#custom-tabs-one-notification" role="tab" aria-controls="custom-tabs-one-notification" aria-selected="false">
                                {{ __('Notification') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-one-subcription-plan-tab" data-toggle="pill" href="#custom-tabs-one-subcription-plan" role="tab" aria-controls="custom-tabs-one-subcription-plan" aria-selected="false">
                                {{ __('Subscription Plan') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-one-password-and-security-tab" data-toggle="pill" href="#custom-tabs-one-password-and-security" role="tab" aria-controls="custom-tabs-one-password-and-security" aria-selected="false">
                                {{ __('Password & Security') }}
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="custom-tabs-one-tabContent">
                        <div class="tab-pane fade active show" id="custom-tabs-one-personal-info" role="tabpanel" aria-labelledby="custom-tabs-one-personal-info-tab">
                            {{ Form::component('personalInfoForm', 'components.form.adminlte.admin.personal-info-admin-form', ['countries' => $countries, 'hashids' => $hashids, 'user' => $user]) }}
                            {{ Form::personalInfoForm() }}
                        </div>
                        <div class="tab-pane fade" id="custom-tabs-one-notification" role="tabpanel" aria-labelledby="custom-tabs-one-notification-tab">
                            {{ __('Notification') }}
                        </div>
                        <div class="tab-pane fade" id="custom-tabs-one-subcription-plan" role="tabpanel" aria-labelledby="custom-tabs-one-subcription-plan-tab">
                            {{ __('Subscription Plan') }}
                        </div>
                        <div class="tab-pane fade" id="custom-tabs-one-password-and-security" role="tabpanel" aria-labelledby="custom-tabs-one-password-and-security-tab">
                            {{ __('Password & Security') }}
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/inputmask-multi/1.2.0/js/jquery.inputmask-multi.min.js" integrity="sha512-uc/k0URVEJ6zKAoRrwd74AENBzCIG7TEeUaTZg76wnjubn22rx/1WTNCeXWbVVUxhKKGHA7XGTtXhhoA2Y4UTQ==" crossorigin="anonymous"></script>

    <script>
        jQuery(document).ready(function()
        {
            // Adds masked input value to unmasket input (hidden input)
            document.getElementById('bnt_save').onclick = function(){
                document.getElementById('customer_phone').value = document.getElementById('phonecode').value;
            };

            // Datepicker for birthday
            jQuery('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
            });

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

        // Phone number without mask
        $('#customer_phone').inputmasks("remove");
        $('#customer_phone').inputmask("+#{*}", maskOpts.inputmask);

        // Phone number with mask
        $('#phonecode').inputmask("remove");
        $('#phonecode').inputmasks(maskOpts);
    </script>
@stop
