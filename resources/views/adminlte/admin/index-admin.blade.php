@extends('adminlte::page')
@section('title', 'Dashboard')

@section('content_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page"><a>{{ __('Dashboard') }}</a></li>
        </ol>
    </nav>
@stop

@section('content')
    <div class="row">
        {{-- Users box --}}
        <div class="col-lg-4 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $usersCount }}</h3>
                    @if($usersCount === 1)
                        <p>{{ __('User') }}</p>
                    @else
                        <p>{{ __('Users') }}</p>
                    @endif
                </div>
                <div class="icon">
                    <i class="fas fa-user-plus"></i>
                </div>
                <a href="/admin/users" class="small-box-footer">
                    {{ __('More info') }}
                    <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        {{-- Tickets box --}}
        <div class="col-lg-4 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $ticketsCount }}</h3>
                    @if($ticketsCount === 1)
                        <p>{{ __('Ticket') }}</p>
                    @else
                        <p>{{ __('Tickets') }}</p>
                    @endif
                </div>
                <div class="icon">
                    <i class="fas fa-ticket-alt"></i>
                </div>
                <a href="/admin/tickets" class="small-box-footer">
                    {{ __('More info') }}
                    <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        {{-- Mmembers box --}}
        <div class="col-lg-4 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $memberCount }}</h3>
                    @if($memberCount === 1)
                        <p>{{ __('Member') }}</p>
                    @else
                        <p>{{ __('Members') }}</p>
                    @endif
                </div>
                <div class="icon">
                    <i class="fas fa-user"></i>
                </div>
                <a href="/admin/team/members" class="small-box-footer">
                    {{ __('More info') }}
                    <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4 col-md-5 col-sm-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h1 class="card-title">
                        <i class="fas fa-user-clock mr-1"></i>
                        {{ __("Latest Users") }}</h1>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    </div>
                </div>

                <div class="card-body">
                    <ul class="users-list clearfix">
                        @foreach($users as $user)
                            <li>

                                @if(file_exists(public_path() . $user->profile_image) && $user->profile_image != '')
                                    <img src="{{ asset($user->profile_image) }}" alt="latest users image">
                                @else
                                    @if($user->gender == 'Male')
                                        <img src="{{ asset('images/256x256/256_1.png') }}" alt="latest users image">
                                    @else
                                        <img src="{{ asset('images/256x256/256_12.png') }}" alt="latest users image">
                                    @endif
                                @endif

                                <a href="{{ 'users/'. $hashids->encode($user->id) }}" class="users-list-name mt-1">{{ $user->name }}</a>
                                <span class="users-list-date">{{ $user->updated_at->format('d/m/Y H:i') }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="card-footer text-center">
                    <a href="/admin/users" class="small-box-footer">
                        {{ __("View All Users") }}
                        <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>

            </div>
        </div>
        <div class="col-lg-8 col-md-7 col-sm-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h1 class="card-title">
                        <i class="fas fa-calendar-alt mr-1"></i>
                        {{ __("Calendar") }}</h1>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    </div>
                </div>

                <div class="card-body pt-0 pb-0">
                    <div id='calendar' class="calendar"></div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('css/adminlte.css') }}">
@stop

@section('js')

@stop
