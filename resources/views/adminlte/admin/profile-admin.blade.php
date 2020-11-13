@extends('adminlte::page')
@section('title', 'Profile')

@section('content_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a>{{ __('Users') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a>{{ __('Profile') }}</a></li>
        </ol>
    </nav>
@stop

@section('content')
    {{-- Back button --}}
    <a class="btn btn-primary mb-3" href="{{ url()->previous() }}" role="button">{{ __('Back') }}</a>

    {{-- Profile info --}}
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-12">
            <div class="card card-outline card-primary">
                <div class="card-body text-center">
                    <img src="{{URL::asset('images/img_profile.png')}}" class="mb-3" style="border-radius: 50%;" height="150" width="150" alt="Profile_pic">
                    <h3>{{ $user->name }}</h3>
                    <h5 class="text-gray">{{ ucfirst($role->name) }}</h5>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-12">
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
                    <div class="Mobile Phone">
                        <b>{{ __('Mobile Phone') }}</b>
                        <p class="text-gray">...</p>
                        <hr>
                    </div>
                    <div class="Location">
                        <b>{{ __('Location') }}</b>
                        <p class="text-gray">...</p>
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
