@extends('adminlte::page')
@section('title', __('New Ticket'))

@section('content_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a>{{ __('Support') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a>{{ __('Create New Ticket') }}</a></li>
        </ol>
    </nav>
@stop

@section('content')
    {{-- Back button --}}
    <a class="btn btn-primary mb-3" href="/user/support/tickets" role="button">
        <i class="fas fa-chevron-left mr-1"></i>
        {{ __('Back') }}
    </a>

    <form method="POST" action="/user/support/tickets/create">
        @method('POST')
        @csrf

        <div class="row">
            <div class="col-lg-4 col-md-12 col-sm-12">
                <x-alertAdmin />
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h1 class="card-title">{{ __('Create New Ticket') }}</h1>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        {{ Form::component('newTicketForm', 'components.form.adminlte.user_admin.add-ticket-form', ['categories' => $categories ]) }}
                        {{ Form::newTicketForm() }}
                    </div>
                </div>
            </div>
        </div>
    </form>
@stop

@section('css')

@stop

@section('js')

@stop
