@extends('layouts.app')

@section('content')
    <section class="AdvancedFeatures">
        <div class="features-wrapper">
            <div class="container">
                <h1 class="FeaturesPageHeader fade-in align-self-center text-center text-md-center text-white font-weight-bold text-shadow">
                    {{ __("All you need to monitor your website") }}
                </h1>

                <div class="row justify-content-between">
                    <div class="col-md-5 m-1">
                        <div class="feature-box">
                            <div class="feature-box-holder"style="left: -3px;top: -25px;">
                                <div class="feature-box-holder-round"></div>
                            </div>

                            <div class="feature-icon-box">
                                <i class="fas fa-tachometer-alt"></i>
                            </div>

                            <div class="feature-label">
                                {{ __("Response time") }}
                            </div>

                            <div class="feature-decr">
                                {{ __("See your response times in a chart and reveal the page slowness.") }}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-5 m-1">
                        <div class="feature-box">
                            <div class="feature-box-holder"style="left: -3px;top: -25px;">
                                <div class="feature-box-holder-round"></div>
                            </div>

                            <div class="feature-icon-box">
                                <i class="fas fa-heartbeat"></i>
                            </div>

                            <div class="feature-label">
                                {{ __("Uptime monitor") }}
                            </div>

                            <div class="feature-decr">
                                {{ __("See how much time in percent your website is available to your visitors.") }}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-5 m-1">
                        <div class="feature-box">
                            <div class="feature-box-holder"style="left: -3px;top: -25px;">
                                <div class="feature-box-holder-round"></div>
                            </div>

                            <div class="feature-icon-box">
                                <i class="fas fa-phone-square-alt"></i>
                            </div>

                            <div class="feature-label">
                                {{ __("On-call") }}
                            </div>

                            <div class="feature-decr">
                                {{ __("Be able to choose people who will receive an alert when your website is broken down.") }}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-5 m-1">
                        <div class="feature-box">
                            <div class="feature-box-holder"style="left: -3px;top: -25px;">
                                <div class="feature-box-holder-round"></div>
                            </div>

                            <div class="feature-icon-box">
                                <i class="fab fa-chrome"></i>
                            </div>

                            <div class="feature-label">
                                {{ __("Website monitoring") }}
                            </div>

                            <div class="feature-decr">
                                {{ __("Be the first who knows that your website is down. Reliable monitoring warns you before some significant troubles and save you money.") }}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-5 m-1">
                        <div class="feature-box">
                            <div class="feature-box-holder"style="left: -3px;top: -25px;">
                                <div class="feature-box-holder-round"></div>
                            </div>

                            <div class="feature-icon-box">
                                <i class="fas fa-download"></i>
                            </div>

                            <div class="feature-label">
                                {{ __("Download speed") }}
                            </div>

                            <div class="feature-decr">
                                {{ __("Check how fast your website is downloading in charts.") }}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-5 m-1">
                        <div class="feature-box">
                            <div class="feature-box-holder"style="left: -3px;top: -25px;">
                                <div class="feature-box-holder-round"></div>
                            </div>

                            <div class="feature-icon-box">
                                <i class="fas fa-shield-alt"></i>
                            </div>

                            <div class="feature-label">
                                {{ __("SSL certificate monitoring") }}
                            </div>

                            <div class="feature-decr">
                                {{ __("Don’t lose visitors because of expired SSL certificate. Get a notification 30 days before expiry so you have time to act.") }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('css')
    <link href="/css/sections/features.blade.css" rel="stylesheet">
@stop