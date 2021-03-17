@extends('layouts.app')

@section('content')
    <section class="pricing">
        <div class="container">
            <div class="row">
                <div class="pricing__lable">
                    <h1 class="FeaturesPageHeader fade-in align-self-center text-center text-md-center text-white font-weight-bold text-shadow">
                        {{ __("Flawless plans that suit you") }}
                    </h1>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-3 m-1">
                    <div class="plan-wrapper">
                        <div class="plan-lable">
                            {{ __("FREE") }}
                        </div>

                        <div class="price-box">
                            {{ __(":price /month", ['price' => '0€']) }}
                        </div>

                        <div class="plan-decription-wrapper">
                            <div class="plan-freature-box">{{ __(":count monitors", ['count' => '2']) }}</div>
                            <div class="plan-freature-box">{{ __(":time min monitoring interval", ['time' => '30']) }}</div>
                            <div class="plan-freature-box">{{ __("No alerts") }}</div>
                            <div class="plan-freature-box">{{ __("HTTP(S) monitoring") }}</div>
                            <div class="plan-freature-box">{{ __("Response time monitoring") }}</div>
                            <div class="plan-freature-box">{{ __("Ping monitoring") }}</div>
                            <div class="plan-freature-box">{{ __("Port monitoring") }}</div>
                            <div class="plan-freature-box">{{ __("No log file") }}</div>
                            <div class="plan-freature-box">{{ __("No SSL check") }}</div>
                        </div>

                        <div class="nav-item payBtn GreyButton">
                            <a class="nav-link btn btn-gray" href="{{ route('login') }}">
                                {{ __("Start monitoring") }}
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 m-1">
                    <div class="plan-wrapper">
                        <div class="plan-lable">
                            {{ __("PRO") }}
                        </div>

                        <div class="price-box">
                            {{ __(":price /month", ['price' => '5€']) }}
                        </div>

                        <div class="plan-decription-wrapper">
                            <div class="plan-freature-box">{{ __(":count monitors", ['count' => '5']) }}</div>
                            <div class="plan-freature-box">{{ __(":time min monitoring interval", ['time' => '5']) }}</div>
                            <div class="plan-freature-box">{{ __("Email alerts") }}</div>
                            <div class="plan-freature-box">{{ __("HTTP(S) monitoring") }}</div>
                            <div class="plan-freature-box">{{ __("Response time monitoring") }}</div>
                            <div class="plan-freature-box">{{ __("Ping monitoring") }}</div>
                            <div class="plan-freature-box">{{ __("Port monitoring") }}</div>
                            <div class="plan-freature-box">{{ __("No log file") }}</div>
                            <div class="plan-freature-box">{{ __("No SSL check") }}</div>
                        </div>

                        <div class="nav-item payBtn OrangeButton">
                            <a class="nav-link btn btn-orange" href="{{ route('login') }}">
                                {{ __("Subscribe now") }}
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 m-1">
                    <div class="plan-wrapper">
                        <div class="plan-lable">
                            {{ __("WEBMASTER") }}
                        </div>

                        <div class="price-box">
                            {{ __(":price /month", ['price' => '10€']) }}
                        </div>

                        <div class="plan-decription-wrapper">
                            <div class="plan-freature-box">{{ __(":count monitors", ['count' => '10']) }}</div>
                            <div class="plan-freature-box">{{ __(":time min monitoring interval", ['time' => '1']) }}</div>
                            <div class="plan-freature-box">{{ __("Email and SMS alerts") }}</div>
                            <div class="plan-freature-box">{{ __("HTTP(S) monitoring") }}</div>
                            <div class="plan-freature-box">{{ __("Response time monitoring") }}</div>
                            <div class="plan-freature-box">{{ __("Ping monitoring") }}</div>
                            <div class="plan-freature-box">{{ __("Port monitoring") }}</div>
                            <div class="plan-freature-box">{{ __("Log file") }}</div>
                            <div class="plan-freature-box">{{ __("SSL check") }}</div>
                        </div>

                        <div class="nav-item payBtn OrangeButton">
                            <a class="nav-link btn btn-orange" href="{{ route('login') }}">
                                {{ __("Subscribe now") }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-9 m-1 enterprise-padding">
                    <div class="plan-wrapper">
                        <div class="plan-lable">
                            {{ __("ENTERPRISE") }}
                        </div>

                        <div class="plan-enterprise-decription-wrapper" style="height: 110px">
                            <div class="plan-freature-box w-80">
                                {{ __("Need something special? No problem, we can handle a custom number of monitors and check-intervals.") }}
                            </div>
                        </div>

                        <div class="nav-item payBtn GreyButton" style="width: 50%" >
                            <a class="nav-link btn btn-gray" href="{{ route('contacts') }}">
                                {{ __("Contact us") }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('css')
 <link href="/css/sections/pricing.css" rel="stylesheet">
@stop