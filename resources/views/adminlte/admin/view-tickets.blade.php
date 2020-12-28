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

    <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="card card-outline">
            <div class="card-header bg-info">
                <h1 class="card-title">{{ '[#' . $ticket->id . ']: ' . $ticket->title }}</h1>
            </div>
            <div class="card-body">

                <h5 class="text-bold mb-0">{{ $ticket->fullname }}</h5>

                <p class="text-gray mb-0">{{ $ticket->email }}</p>

                <p class="text-gray">{{ date('d/m/Y H:i', strtotime($ticket->created_at)) }}</p>

                <p>{{ $ticket->message }}</p>

                <p class="mt-5 ml-2 mb-0">
                    <strong>{{ __('Tickets ID') . ': ' }}</strong>{{ __($ticket->id) }}
                </p>

                <p class="ml-2 mb-0">
                    <strong>{{ __('Title') . ': ' }}</strong>{{ __($ticket->title) }}
                </p>

                <p class="ml-2 mb-0">
                    <strong>{{ __('Type') . ': ' }}</strong>{{ __($ticket->type) }}
                </p>

                <p class="ml-2 mb-0">
                    <strong>{{ __('Action') . ': ' }}</strong>{{ __($ticket->action) }}
                </p>

                <p class="ml-2 mb-0">
                    <strong>{{ __('Status') . ': ' }}</strong>{{ __($ticket->status) }}
                </p>

            </div>
        </div>
    </div>

{{--    <div class="col-lg-6 col-md-6 col-sm-12">--}}
{{--        <div class="card card-outline">--}}
{{--            <div class="card-header bg-info">--}}
{{--                <h1 class="card-title">{{ __('Message') }}</h1>--}}
{{--            </div>--}}
{{--            <div class="card-body">--}}
{{--                <div class="row">--}}
{{--                    <div class="col-lg-6 col-md-6 col-sm-12 Title">--}}
{{--                        <p class="text-gray">{{ $ticket->title }}</p>--}}
{{--                    </div>--}}
{{--                    <div class="col-lg-6 col-md-6 col-sm-12 text-right">--}}
{{--                        <p class="text-gray">{{ date('d/m/Y H:i', strtotime($ticket->created_at)) }}</p>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="mt-2">--}}
{{--                    <p class="text-gray">{{ $ticket->message }}</p>--}}
{{--                </div>--}}

{{--                <div class="Type">--}}
{{--                    <b>{{ __('Type') }}</b>--}}
{{--                    <p class="text-gray">{{ __($ticket->type) }}</p>--}}
{{--                    <hr>--}}
{{--                </div>--}}
{{--                <div class="Status">--}}
{{--                    <b>{{ __('Status') }}</b>--}}
{{--                    <p class="text-gray">{{ __($ticket->status) }}</p>--}}
{{--                    <hr>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
@stop

@section('css')

@stop

@section('js')

@stop
