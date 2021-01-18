@extends('adminlte::page')
@section('title', 'Settings')

@section('content_header')
    <h1>Settings</h1>
@stop

@section('content')
    <section class="settings_header">
        <div class="settings_header_content">
        <div class="user-img-box">
            <div class="user-img-box__img">

            </div>
        </div>
        <div class="title_wrapper">
            <div class="title-user-name">Rolands Bidzāns</div>
            <div class="title-user-email">Rolandsnorigas@gmail.com</div>
        </div>
        <div class="dropdown">
            {{-- <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Dropdown button
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item" href="#">Action</a>
              <a class="dropdown-item" href="#">Another action</a>
              <a class="dropdown-item" href="#">Something else here</a>
            </div> --}}
          </div>
        </div>
    </section>

    <section class="settings-menu-wrapper">
        <ul class="settings-links">
            <li class="settings-links__item">Account settings</li>
            <li class="settings-links__item">Priccing and billing</li>
        </ul>
        <div class="settings-menu-wrapper__line"></div>
    </section>

    <section class="userProfileSettings">
        <div class="userProfileSettings__header">
            <i class="fas fa-user-cog userProfileSettings__icon"></i>
            <div class="userProfileSettings__title"><span>Account information</span></div>
        </div>
        <div class="container">
            <div class="row user-info-wrapper">
                    <div class="col-md-2">
                        <div class="user-img-box">
                            <div class="user-img-box__img">
                
                            </div>
                        </div>
                        <button type="button" class="btn btn-dark">Change image</button>
                    </div>
                    <div class="col-md-5 user-info-box">

                    </div>
                    <div class="col-md-5 user-info-box">

                    </div>
                
            </div>
        </div>
       
    </section>
@stop

@section('css')
    <link rel="stylesheet" href="/css/app.css">
@stop

@section('js')

@stop
