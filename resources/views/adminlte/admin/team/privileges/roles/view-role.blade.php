@extends('adminlte::page')
@section('title', 'View Role')

@section('content_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a>{{ __('Team') }}</a></li>
            <li class="breadcrumb-item"><a>{{ __('Privileges') }}</a></li>
            <li class="breadcrumb-item"><a>{{ __('Roles') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('View Role') }}</li>
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
        <div class="col-lg-3 col-md-3 col-sm-12">
            <div class="card card-outline">
                <div class="card-header bg-info">
                    <h1 class="card-title">{{ __('Info') }}</h1>
                </div>
                <div class="card-body">
                    <div class="ID">
                        <b>{{ __('ID') }}</b>
                        <p class="text-gray">{{ $role->id }}</p>
                        <hr>
                    </div>
                    <div class="Name">
                        <b>{{ __('Name') }}</b>
                        <p class="text-gray">{{ $role->name }}</p>
                        <hr>
                    </div>
                    <div class="DisplayName">
                        <b>{{ __('Display name') }}</b>
                        <p class="text-gray">{{ $role->display_name }}</p>
                        <hr>
                    </div>
                    <div class="Description">
                        <b>{{ __('Description') }}</b>
                        <p class="text-gray">{{ $role->description }}</p>
                        <hr>
                    </div>
                    <div class="CreatedAt">
                        <b>{{ __('Created at') }}</b>
                        <p class="text-gray">{{ $role->created_at }}</p>
                        <hr>
                    </div>
                    <div class="UpdatedAt">
                        <b>{{ __('Updated at') }}</b>
                        <p class="text-gray">{{ $role->updated_at }}</p>
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
