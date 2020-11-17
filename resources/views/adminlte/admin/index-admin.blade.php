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
        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $users }}</h3>
                    @if($users === 1)
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
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $tickets }}</h3>
                    @if($tickets === 1)
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
    </div>
@stop

@section('css')

@stop

@section('js')

@stop
