@extends('adminlte::page')
@section('title', 'Settings')

@section('content_header')
    <h1>Settings</h1>
@stop

@section('content')
<section class="userSettings">
    <div class="row justify-content-center">
        <div class="col-md-10 menuHeader">
            <ul class="settings-links">
                <li class="settings-links-item" id='acountLink'>{{ __('Account') }}</li>
                <li class="settings-links-item" id='notificationLink'>{{ __('Notifications') }}</li>
                <li class="settings-links-item" id='priccingLink'>{{ __('Priccing and billing') }}</li>
            </ul>
        </div>
    </div>
    <div class="row justify-content-center ">
        <div class="col-md-10 user-header">
            <div class="user-image-wrapper">
                <div class="user-image-box ">
                    <img src="https://image.shutterstock.com/image-photo/young-designer-giving-some-new-600w-681206938.jpg" alt="">
                </div>
                <div class="btnChangeImg">
                    <i class="fas fa-plus"></i>
                </div>
                <div class="addImageDecr">
                    <p class="addImageDecr-p" style="margin: 0;">{{ __('Click to change your avatar') }}</p>
                </div>
            </div>
            <div class="userInfoWrapper">
                <div class="userName">{{ $userName->name }}</div>
                <div class="userEmail">{{$email->email}}</div>
            </div>

        </div>
        <div class="col-md-10 infoWrapper" id="userInfoPage" style="background-color: white; padding: 0">
            <div class="header2">
                <h2>{{ __('User Information') }}</h2>
            </div>
            <form action="/user/settings" method="POST">
                @csrf
                <div class="userSettingsWrapper">
                    <div class="userSettingsWrapper-item">   
                        <label for="fullName">{{ __('Full name') }}</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="fas fa-user-secret"></i></span>
                            </div>
                            <input type="text" name="fullName" class="form-control" id="fullName" placeholder="Full name" data-mask="" im-insert="false" value="{{ $userName->name }}">
                        </div>
                    </div>
                    <div class="userSettingsWrapper-item">   
                        <label for="email">{{ __('Email Address') }}</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="fas fa-at"></i></span>
                            </div>
                            <input type="text" name="email" class="form-control" data-inputmask-alias="inputEmail" placeholder="Email" data-mask="" im-insert="false" value="{{$email->email}}">
                        </div>
                    </div>
    
                    <div class="userSettingsWrapper-item">
                        <label for="gender">{{ __('Gender') }}</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-venus-mars"></i></span>
                            </div>
                            <select name="gender" class="form-control select2bs4 select2-hidden-accessible"  data-select2-id="25" tabindex="-1" aria-hidden="true">
                              <option selected="selected" disabled="disabled" data-select2-id="26">{{ __('Select your gender') }}</option>
                              <option data-select2-id="27">{{ __('Male') }}</option>
                              <option data-select2-id="28">{{ __('Female') }}</option>
                            </select>
                        </div>
                    </div>
    
                    <div class="userSettingsWrapper-item">
                        <label for="phone">{{ __('Phone number') }}</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="fas fa-phone"></i></span>
                            </div>
                            <input type="text" name="phone" class="form-control" im-insert="true" id="phone" placeholder="(371) __  __  __">
                        </div>
                    </div>
    
                    <div class="userSettingsWrapper-item">
                        <label for="birthday">{{ __('Birthday') }}</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </div>
                            <input type="text" name="birthday" id='birthday' class="form-control" value="{{$birthDay->birthday}}">
                        </div>
                    </div>
    
                    <div class="userSettingsWrapper-item">
                        <label for="country">{{ __('Country') }}</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="fas fa-globe-europe"></i></span>
                            </div>
                            <select name="country" class="form-control select2bs4 select2-hidden-accessible" id='countrySelector' aria-hidden="true">
                                @foreach ($countries as $country)
                                {{-- {{ $country->name }} --}}
                                    <option value="{{ $country->name }}">{{ $country->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
    
                    <div class="userSettingsWrapper-item">
                        <label for="city">{{ __('City') }}</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="fas fa-city"></i></span>
                            </div>
                            <input type="text" name="city" class="form-control"  data-mask="" im-insert="false" value="{{$city->city}}">
                        </div>
                    </div>
                </div>
                <div type="submit" class="settingsBtnWrapper" style="width: 180px; margin: 0 auto">
                    <button class="settingsBtn successBtn" id='deleteAcountBtn'>
                        <i class="fas fa-user-edit"></i>
                    </button>
                    <button type="submit" class="settingsBtnContent successBtnContent" style="width: 160px">{{ __('Update information') }}</button>
                </div>
            </form>
            
        </div>

        <div class="col-md-10 header2">
            <h2>{{ __('Password & Security') }}</h2>
        </div>

        <div class="col-md-10" id="userPaswordPage" style="background-color: white; padding: 10px 0">
            <div class="userSettingsWrapper">
                <div class="userSettingsWrapper-item">
                    <label>{{ __('Old Password') }}</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-unlock-alt"></i></span>
                        </div>
                        <input type="password" name="p" class="form-control" id="Password1" placeholder="Password">
                    </div>
                </div>

                <div class="userSettingsWrapper-item">
                    <label>{{ __('New Password') }}</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-key"></i></span>
                        </div>
                        <input type="password" name="2" class="form-control" id="Password2" placeholder="New password" disabled>
                    </div>
                </div>
                
    
                <div class="userSettingsWrapper-item">
                    <label>{{ __('Confirm New Password') }}</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-key"></i></span>
                        </div>
                        <input type="password" name="3" class="form-control" id="Password3" placeholder="confirm password" disabled> 
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-10 d-flex justify-content-center" style="background-color: white">
            <div class="settingsBtnWrapper">
                <button class="settingsBtn successBtn" id='deleteAcountBtn'>
                    <i class="fas fa-lock"></i>
                </button>
                <div class="settingsBtnContent successBtnContent">{{ __('Update password') }}</div>
            </div>
        </div>
        
        <div class="col-md-10 deleteAcountWrapper">
            <h2>{{ __('DELETE this account') }}</h2>
            <p>{{ __('Deleting the account will delete all the associated data permanently.') }}</p>
            <div class="deleteAccountBox">
                <div class="deleteAccountBox-decr">
                    <div class="deleteAccountBox-title">{{ __('Current Owner') }}</div>
                    <p>{{ $email->email }}</p>
                </div>
                <div class="settingsBtnWrapper">
                    <button class="settingsBtn" id='deleteAcountBtn'>
                        <i class="fas fa-user-slash"></i>
                    </button>
                    <div class="settingsBtnContent">{{ __('Delete account') }}</div>
                </div>
            </div>
        </div>
    </div>

</section>
@stop

@section('css')
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@stop

@section('js')
    <script src="{{ url('vendor/jquery.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script type="text/javascript">

    $(function(){
        //GLOBAL VARIABLES
        let countriesData = <?php echo json_encode($countries); ?>;


        //FUNCTIONS

        $('#deleteAcountBtn').click(function(){
            console.log($('#phone').val());
        });


        //EVENT LISTENERS

        // $('#acountLink').click( function(){
        //     $("#userIfoPage infoWrapper").css({"display":"block"});
        //     $("#userPasswordPage").css({"display":"none"});
        // });

        // $('#notificationLink').click( function(){
        //     $("#userIfoPage infoWrapper").css({"display":"none"});
        //     $("#userPasswordPage").css({"display":"block"});
        // });

        // $('#priccingLink').click( function(){

        // });

        //Password forms value changed script
        $("#Password1").on('input', function(){
            if(($(this).val()).length > 4){
                if(($("#Password2").val()).length > 4){
                    $("#Password3").removeAttr("disabled");
                }
                $("#Password2").removeAttr("disabled");
            }else{
                $("#Password2").attr('disabled','disabled');  
                $("#Password3").attr('disabled','disabled'); 
                $("#Password3").val('');
            }
        });

        $("#Password2").on('input', function(){
            if(($(this).val()).length > 4){
                $("#Password3").removeAttr("disabled");
            }else{
                $("#Password3").attr('disabled','disabled'); 
                $("#Password3").val('');
            }
        });

        $('#countrySelector').change( function() {
            let countryName = $( "select#countrySelector option:checked" ).val();
            changedPhoneFormat(countryName);
        });

        function changedPhoneFormat(country) {

            for (const property in countriesData) {
                if(countriesData[property]['name'] == country) {
                    $('#phone').mask(`(${countriesData[property]['dial_code']}) 99 999 999`, 
                    {
                        placeholder:`(${countriesData[property]['dial_code']}) ___ ___ ___`
                    });
                    $('#phone').attr('placeholder', `(${countriesData[property]['dial_code']}) __  __  __`);
                    $('#phone').val('');
                    break;
                }
            }
        }

        //MASKS
        $('#phone').mask('(+371) 99 999 999', 
        {
            placeholder:"(+371) ___ ___ ___"
        });

        $('#birthday').datepicker({ dateFormat: 'yy/mm/dd' });

        $('#birthday').mask('9999/99/99',{placeholder:"yyyy/mm/dd"});
        $('#birthday').attr('placeholder', 'yyyy/mm/dd');
    });


    </script>
@stop
