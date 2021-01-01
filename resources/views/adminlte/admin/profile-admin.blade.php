@extends('adminlte::page')
@section('title', 'Profile')

@section('content_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page"><a>{{ __('Profile') }}</a></li>
        </ol>
    </nav>
@stop

@section('content')
    {{-- Back button --}}
    <a class="btn btn-primary mb-3" href="{{ url()->previous() }}" role="button">
        <i class="fas fa-chevron-left mr-1"></i>
        {{ __('Back') }}
    </a>

    {{-- Profile info --}}
    <div class="row">
        <div class="col-lg-5 col-md-6 col-sm-12">
            <div class="card card-outline card-primary">
                <div class="card-body text-center">

                    @if(file_exists(public_path() . $user->profile_image) && $user->profile_image != '')
                        <img src="{{ asset($user->profile_image) }}" class="mb-2" alt="profile_pic" style="border-radius: 50%; width: 250px; height: 250px; max-width: 100%;">
                    @else
                        @if($user->gender == 'Male')
                            <img src="{{ asset('images/256x256/256_1.png') }}" class="mb-2" alt="profile_pic_default" style="border-radius: 50%; width: 250px; height: 250px; max-width: 100%;">
                        @else
                            <img src="{{ asset('images/256x256/256_12.png') }}" class="mb-2" alt="profile_pic_default" style="border-radius: 50%; width: 250px; height: 250px; max-width: 100%;">
                        @endif
                    @endif

                    <h3>{{ $user->name }}</h3>
                    <h5 class="text-gray">{{ ucfirst($role->name) }}</h5>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-5 col-md-6 col-sm-12">
            <div class="card card-outline">
                <div class="card-header bg-info">
                    <h1 class="card-title">{{ __('Info') }}</h1>
                </div>
                <div class="card-body">
                    <div class="Email">
                        <b>{{ __('Email') }}</b>
                        <p class="text-gray">{{ $user->email }}</p>
                        <hr>
                    </div>
                    <div class="Gender">
                        <b>{{ __('Gender') }}</b>
                        <p class="text-gray">{{ __($user->gender) }}</p>
                        <hr>
                    </div>
                    <div class="Birthday">
                        <b>{{ __('Birthday') }}</b>
                        <p class="text-gray">{{ date('d.m.Y', strtotime($user->birthday)) }}</p>
                        <hr>
                    </div>
                    <div class="Mobile Phone">
                        <b>{{ __('Mobile Phone') }}</b>
                        <p class="text-gray">{{ !empty($user->phone_number) ? $user->phone_number : "" }}</p>
                        <hr>
                    </div>
                    <div class="Location">
                        <b>{{ __('Location') }}</b>
                        <p class="text-gray">{{ !empty($countryName[$user->id]->name) ? __($countryName[$user->id]->name) . ', ' . $user->city : "" }}</p>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')

@stop

@section('js')

@stop
