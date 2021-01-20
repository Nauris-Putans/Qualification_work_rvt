@extends('layouts.app')

@section('content')

    <section class="homeIntroduce">
        <div class="container">
            <h1>BE UPTIME WITH WEBCHECK</h1>
            <div class="titleDecr">
                Monitoring services that allows you to <br> check about your website statistics -<br> Ping, Port, Response time, SSL<br> Certification Check and much more
            </div>
            <button type="button" class="btn btn-warning">TRY IT FREE</button>
        </div>
    </section>

    <section class="features">
        <div class="container">
            <h2>Features</h2>
            <div class="row ">
                <div class="col-md-4 " >
                    <div class="featureBox">
                        <div class="featureBox_header">
                            <img src="{{ URL::asset('/images/homePage/icons/speed.png') }}" alt="speed icon">
                            Monitoring <br>Frequency
                        </div>
                        <div class="featureBox_line"></div>
                        <div class="featureBox_decr">
                            At your users control panel you can choose how often your website will be checked. You have the ability to monitor any port or website every 1, 2, 3, 5, 10, 15, 30 and 60 minutes.
                        </div>
                        <div class="featureBox_link">
                            <a href="{{ route('features') }}">more</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="featureBox">
                        <div class="featureBox_header">
                            <img src="{{ URL::asset('/images/homePage/icons/alerts.png') }}" alt="speed icon">
                            Instant <br>Notifications
                        </div>
                        <div class="featureBox_line"></div>
                        <div class="featureBox_decr">
                            Never miss any problem on your website by our E-mail, SMS notifications.
                        </div>
                        <div class="featureBox_link">
                            <a href="{{ route('features') }}">more</a>
                        </div>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="featureBox">
                        <div class="featureBox_header">
                            <img src="{{ URL::asset('/images/homePage/icons/support.png') }}" alt="speed icon">
                            Support
                        </div>
                        <div class="featureBox_line"></div>
                        <div class="featureBox_decr">
                            When you have any questions we are always  happy to help.
                        </div>
                        <div class="featureBox_link">
                            <a href="{{ route('features') }}">more</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="advantages">
        <div class="container">
            <h2>OUR ADVANTAGES</h2>
            <div class="row text-center">
                <div class="col-md-4">
                    <div class="advantage_box">
                        <div class="advantage_box_img">
                            <img src="{{ URL::asset('/images/homePage/icons/lowprice.png') }}" alt="speed icon">
                        </div>
                        <div class="advantage_box_decr">
                            LOW PRICING
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="advantage_box">
                        <div class="advantage_box_img">
                            <img src="{{ URL::asset('/images/homePage/icons/security.png') }}" alt="speed icon">
                        </div>
                        <div class="advantage_box_decr">
                            SECURITY
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="advantage_box">
                        <div class="advantage_box_img">
                            <img src="{{ URL::asset('/images/homePage/icons/work.png') }}" alt="speed icon">
                        </div>
                        <div class="advantage_box_decr">
                            FAST SUPPORT
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="pricing">
        <div class="container">
            <div class="row">
                <div class="pricing__lable">
                    Choose a plan
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="plan-wrapper">
                        <div class="plan-lable">Free</div>
                        <div class="price-box">0 /month</div>
                        <div class="plan-decription-wrapper">
                            <div class="plan-freature-box">2 monitors</div>
                            <div class="plan-freature-box">30 min monitoring interval</div>
                            <div class="plan-freature-box">No alerts</div>
                            <div class="plan-freature-box">HTTP(S) monitoring</div>
                            <div class="plan-freature-box">Response time monitoring</div>
                            <div class="plan-freature-box">Ping monitoring</div>
                            <div class="plan-freature-box">Port monitoring</div>
                            <div class="plan-freature-box">No logging</div>
                            <div class="plan-freature-box">No SSL check</div>
                        </div>
                        <div class="nav-item payBtn">
                            <a class="nav-link btn btn-gray" href="{{ route('login') }}">{{ __('Start monitoring') }}</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="plan-wrapper">
                        <div class="plan-lable">PRO</div>
                        <div class="price-box">5 /month</div>
                        <div class="plan-decription-wrapper">
                            <div class="plan-freature-box">5 monitors</div>
                            <div class="plan-freature-box">5 min monitoring interval</div>
                            <div class="plan-freature-box">Email alerts</div>
                            <div class="plan-freature-box">HTTP(S) monitoring</div>
                            <div class="plan-freature-box">Response time monitoring</div>
                            <div class="plan-freature-box">Ping monitoring</div>
                            <div class="plan-freature-box">Port monitoring</div>
                            <div class="plan-freature-box">No logging file</div>
                            <div class="plan-freature-box">No SSL check</div>
                        </div>
                        <div class="nav-item payBtn">
                            <a class="nav-link btn btn-orange" href="{{ route('login') }}">{{ __('Subscribe now') }}</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="plan-wrapper">
                        <div class="plan-lable">WEBMASTER</div>
                        <div class="price-box">10 /month</div>
                        <div class="plan-decription-wrapper">
                            <div class="plan-freature-box">10 monitors</div>
                            <div class="plan-freature-box">1 min monitoring interval</div>
                            <div class="plan-freature-box">Email and SMS alerts</div>
                            <div class="plan-freature-box">HTTP(S) monitoring</div>
                            <div class="plan-freature-box">Response time monitoring</div>
                            <div class="plan-freature-box">Ping monitoring</div>
                            <div class="plan-freature-box">Port monitoring</div>
                            <div class="plan-freature-box">Logging file</div>
                            <div class="plan-freature-box">SSL check</div>
                        </div>
                        <div class="nav-item payBtn">
                            <a class="nav-link btn btn-orange" href="{{ route('login') }}">{{ __('Subscribe now') }}</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="plan-wrapper">
                        <div class="plan-lable">ENTERPRISE</div>
                        <div class="plan-enterprise-decription-wrapper">
                            Need something special? No problem, we can handle a custom number of monitors and check-intervals.
                        </div>
                        <div class="nav-item payBtn">
                            <a class="nav-link btn btn-gray" href="{{ route('login') }}">{{ __('Contact us') }}</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="plan-end-line"></div>
    </section>
@endsection
