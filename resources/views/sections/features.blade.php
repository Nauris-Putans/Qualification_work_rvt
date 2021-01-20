@extends('layouts.app')

@section('content')

<section class="FeaturesPageHeader">
    <div class="titleBox">ALL YOU NEED TO MONITOR YOUR WEBSITE</div>
</section>

<section class="AdvancedFeatures">
    <div class="features-wrapper">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-md-5 m-1">
                    <div class="feature-box">
                        <div class="feature-box-holder"style="left: -3px;top: -25px;">
                            <div class="feature-box-holder-round"></div>
                        </div>

                        <div class="feature-icon-box">
                            <i class="fas fa-tachometer-alt"></i>
                        </div>
                        <div class="feature-label">Response time</div>
                        <div class="feature-decr">See your response times in a chart and reveal the page slowness.</div>

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
                        <div class="feature-label">Uptime monitor</div>
                        <div class="feature-decr">See how much time in percent your website is aivailable to your visitors.</div>

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
                        <div class="feature-label">On-call</div>
                        <div class="feature-decr">Be able to choose people who will recive an alert when your website is broken down.</div>

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
                        <div class="feature-label">Website monitoring</div>
                        <div class="feature-decr">Be the first who knows that your website is down. Reliable monitoring warns you before some significant troubles and save you money.</div>

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
                        <div class="feature-label">Download speed</div>
                        <div class="feature-decr">Check how fast your website is downloading in charts.</div>

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
                        <div class="feature-label">SSL certificate monitoring</div>
                        <div class="feature-decr">Don’t lose visitors because of expired SSL certificate. Get a notification 30 days before expiry so you have time to act.</div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

@endsection
