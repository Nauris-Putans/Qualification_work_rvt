@extends('adminlte::page')
@section('title', __('Profile'))

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

    <div class="container-fluid">
        <div class="row">
            <div class="col-3">
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
                        <h5 class="text-gray">{{ __($role->display_name) }}</h5>
                    </div>
                </div>
                <div class="card card-outline">
                    <div class="card-header bg-info">
                        <h1 class="card-title">{{ __('Info') }}</h1>
                    </div>
                    <div class="card-body">
                        <div class="Email">
                            <b>{{ __('Email') }}</b>
                            <p class="text-gray">{{ !empty($user->email) ? $user->email : __("No data") }}</p>
                            <hr>
                        </div>
                        <div class="Gender">
                            <b>{{ __('Gender') }}</b>
                            <p class="text-gray">{{ !empty($user->gender) ? __($user->gender) : __("No data") }}</p>
                            <hr>
                        </div>
                        <div class="Birthday">
                            <b>{{ __('Birthday') }}</b>
                            <p class="text-gray">{{ !empty($user->birthday) ? date('d/m/Y', strtotime($user->birthday)) : __("No data") }}</p>
                            <hr>
                        </div>
                        <div class="Mobile Phone">
                            <b>{{ __('Mobile Phone') }}</b>
                            <p class="text-gray">{{ !empty($user->phone_number) ? $user->phone_number : __("No data") }}</p>
                            <hr>
                        </div>
                        <div class="Location">
                            <b>{{ __('Location') }}</b>
                            <p class="text-gray">{{ !empty($countryName[$user->id]->name) ? __($countryName[$user->id]->name) . ', ' . $user->city : __("No data") }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-9">
                <div class="card card-outline">
                    <div class="card-header bg-info">
                        <h1 class="card-title">{{ __('Activity') }}</h1>
                    </div>

                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="activity">
                                <div class="tab-pane active" id="timeline">
                                    @if($invoices->isEmpty())
                                        <a>{{ __('No activity for this user') }}</h3>
                                    @else
                                        <div class="timeline timeline-inverse">
                                            @foreach ($invoices as $invoice)
                                                <div class="time-label">
                                                    <span class="bg-green">
                                                        {{ strftime("%d %b", strtotime($invoice->date()->setTimezone(new DateTimeZone('Europe/Riga')))) }}
                                                        <input name="stop" type="hidden" value="stop">
                                                    </span>
                                                </div>

                                                <div>
                                                    <i class="fas fa-file-invoice bg-primary"></i>

                                                    <div class="timeline-item">
                                                        <span class="time">
                                                            <i class="far fa-clock"></i>{{ strftime(" %H:%M", strtotime($invoice->date()->setTimezone(new DateTimeZone('Europe/Riga')))) }}
                                                        </span>

                                                        <h3 class="timeline-header">{{ __('Subscription invoice') }}</h3>

                                                        <div class="timeline-body">
                                                            {{ __($invoice->lines->data[0]->description) }}
                                                        </div>

                                                        <div class="timeline-footer">
                                                            <a href="{{ route('invoice.download', ['invoice' => $invoice->id, 'userID' => $user->id]) }}" class="btn btn-info btn-sm">{{ __('Download .pdf') }}</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
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
