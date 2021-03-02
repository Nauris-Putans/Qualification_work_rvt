@extends('layouts.app')

@section('content')
    <section class="homeIntroduce">
        <div class="container">
            <h1>
                {{ __("BE UPTIME WITH WEBCHECK") }}
            </h1>

            <div class="titleDecr">
                {!! __("Monitoring services that allows you to <br> check about your website statistics -<br> Port, Response time, SSL<br> Certification check and much more") !!}
            </div>

            <a type="button" class="btn btn-orange" style="margin-top: 90px;">
                {{ __("TRY IT FREE") }}
            </a>
        </div>
    </section>

    <section class="features">
        <div class="container">
            <h2>
                {{ __("Features") }}
            </h2>

            <div class="row">
                <div class="col-md-4">
                    <div class="featureBox">
                        <div class="featureBox_header">
                            <img src="{{ URL::asset('/images/homePage/icons/speed.png') }}" alt="speed icon">
                            {!! __("Monitoring <br> Frequency") !!}
                        </div>

                        <div class="featureBox_line"></div>

                        <div class="featureBox_decr">
                            {{ __("At your users control panel you can choose how often your website will be checked. You have the ability to monitor any port or website every 1, 2, 3, 5, 10, 15, 30 and 60 minutes.") }}
                        </div>

                        <div class="featureBox_link">
                            <a href="{{ route('features') }}">
                                {{ __("more") }}
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="featureBox">
                        <div class="featureBox_header">
                            <img src="{{ URL::asset('/images/homePage/icons/alerts.png') }}" alt="speed icon">
                            {!! __("Instant <br> Notifications") !!}
                        </div>

                        <div class="featureBox_line"></div>

                        <div class="featureBox_decr">
                            {{ __("Never miss any problem on your website by our E-mail, SMS notifications.") }}
                        </div>

                        <div class="featureBox_link">
                            <a href="{{ route('features') }}">
                                {{ __("more") }}
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="featureBox">
                        <div class="featureBox_header">
                            <img src="{{ URL::asset('/images/homePage/icons/support.png') }}" alt="speed icon">
                            {{ __("Support") }}
                        </div>

                        <div class="featureBox_line"></div>

                        <div class="featureBox_decr">
                            {{ __("When you have any questions we are always happy to help.") }}
                        </div>

                        <div class="featureBox_link">
                            <a href="{{ route('features') }}">
                                {{ __("more") }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="advantages">
        <div class="container">
            <h2>
                {{ __("Our Advantages") }}
            </h2>

            <div class="row text-center">
                <div class="col-md-4">
                    <div class="advantage_box">
                        <div class="advantage_box_img mb-3">
                            <img src="{{ URL::asset('/images/homePage/icons/lowprice.png') }}" alt="speed icon">
                        </div>

                        <div class="advantage_box_decr">
                            {{ __("LOW PRICING") }}
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="advantage_box">
                        <div class="advantage_box_img mb-3">
                            <img src="{{ URL::asset('/images/homePage/icons/security.png') }}" alt="speed icon">
                        </div>

                        <div class="advantage_box_decr">
                            {{ __("SECURITY") }}
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="advantage_box">
                        <div class="advantage_box_img mb-3">
                            <img src="{{ URL::asset('/images/homePage/icons/work.png') }}" alt="speed icon">
                        </div>

                        <div class="advantage_box_decr">
                            {{ __("FAST SUPPORT") }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="pricing">
        <div class="container mb-5">
            <div class="row">
                <div class="pricing__lable">
                    <h2>
                        {{ __("Choose a plan") }}
                    </h2>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
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
                                {{ __('Start monitoring') }}
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
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
                                {{ __('Subscribe now') }}
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
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
                                {{ __('Subscribe now') }}
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="plan-wrapper">
                        <div class="plan-lable">
                            {{ __("ENTERPRISE") }}
                        </div>

                        <div class="plan-enterprise-decription-wrapper">
                            {{ __("Need something special? No problem, we can handle a custom number of monitors and check-intervals.") }}
                        </div>

                        <div class="nav-item payBtn GreyButton">
                            <a class="nav-link btn btn-gray" href="{{ route('contacts') }}">
                                {{ __('Contact us') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- <div class="plan-end-line"></div> --}}
    </section>
@endsection
