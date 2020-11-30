@extends('adminlte::page')
@section('title', 'Ticket')

@section('content_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page"><a>{{ __('Ticket') }}</a></li>
        </ol>
    </nav>
@stop

@section('content')
    {{-- Back button --}}
    <a class="btn btn-primary mb-3" href="{{ url()->previous() }}" role="button">
        <i class="fas fa-chevron-left mr-1"></i>
        {{ __('Back') }}
    </a>

    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="card card-outline">
                <div class="card-header bg-info">
                    <h1 class="card-title">{{ __('Info') }}</h1>
                </div>
                <div class="card-body">
                    <div class="Title">
                        <b>{{ __('Title') }}</b>
                        <p class="text-gray">{{ $ticket->title }}</p>
                        <hr>
                    </div>
                    <div class="Type">
                        <b>{{ __('Type') }}</b>
                        <p class="text-gray">{{ __($ticket->type) }}</p>
                        <hr>
                    </div>
                    <div class="Full-name">
                        <b>{{ __('Full Name') }}</b>
                        <p class="text-gray">{{ $ticket->fullname }}</p>
                        <hr>
                    </div>
                    <div class="Email">
                        <b>{{ __('Email') }}</b>
                        <p class="text-gray">{{ $ticket->email }}</p>
                        <hr>
                    </div>
                    <div class="Message">
                        <b>{{ __('Message') }}</b>
                        <p class="text-gray">{{ $ticket->message }}</p>
                        <hr>
                    </div>
                    <div class="Sent">
                        <b>{{ __('Sent') }}</b>
                        <p class="text-gray">{{ $ticket->created_at }}</p>
                        <hr>
                    </div>
                    <div class="Status">
                        <b>{{ __('Status') }}</b>
                        <p class="text-gray">{{ __($ticket->status) }}</p>
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
