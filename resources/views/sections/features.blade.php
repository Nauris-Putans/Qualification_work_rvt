@extends('layouts.app')

@section('content')

<section class="mainFeatures">
    <div class="container">
        <h2>All you need to monitor your website.</h2>
        <div class="mainFeatures_line"></div>
        <div class="row">
            <div class="col-md-5 offset-md-1">
                <div class="mainFeatures_box">
                    <div class="mainFeaturesBox_img">
                        <img src="/images/homePage/icons/security2.png" alt="SSL icon">
                    </div>

                    <div class="mainFeaturesBox_line"></div>
                    <div class="mainFeaturesBox_decr">
                        SSL certificate monitoring<br>
                        Don’t lose visitors because of expired SSL certificate. Get a notification 30 days before expiry so you have time to act.
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="mainFeatures_box">
                    <div class="mainFeaturesBox_img">
                        <img src="/images/homePage/icons/website.png" alt="SSL icon">
                    </div>

                    <div class="mainFeaturesBox_line"></div>
                    <div class="mainFeaturesBox_decr">
                        Website monitoring<br>
                        Be the first who knows that your website is down. Reliable monitoring warns you before some significant troubles and save you money.
                    </div>
                </div>
            </div>
            <div class="col-md-5 offset-md-1">
                <div class="mainFeatures_box">
                    <div class="mainFeaturesBox_img">
                        <img src="/images/homePage/icons/search.png" alt="SSL icon">
                    </div>

                    <div class="mainFeaturesBox_line"></div>
                    <div class="mainFeaturesBox_decr">
                        Port & ping monitoring<br>
                        Check your server and monitor any specific port you want.
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="mainFeatures_box">
                    <div class="mainFeaturesBox_img">
                        <img src="/images/homePage/icons/server_clocks.png" alt="SSL icon">
                    </div>

                    <div class="mainFeaturesBox_line"></div>
                    <div class="mainFeaturesBox_decr">
                        Cron job monitoring (heartbeat)<br>
                        You send request and we check if it arrives on time. Great way to monitor server-side jobs or intranet devices connected to the internet.
                    </div>
                </div>
            </div>
        </div>

        <button href="/home" class="btn btn-warning">Start your free trial now</button>
    </div>
</section>

<section class="advancedFeatures">
    <div class="container">
        <h2>All you need to monitor your website.</h2>
        <div class="advancedFeatures_line"></div>
        <div class="row">
            <div class="col-md-5 offset-md-1">
                <div class="advancedFeatures_box">
                    <div class="advancedFeatures_img">
                        <img src="/images/homePage/icons/circledchevronright.png" alt="SSL icon">
                    </div>
                    <div class="advancedFeatures_decr">
                        Response times <br>
                        See your response times in a chart and reveal the page slowness.
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="advancedFeatures_box">
                    <div class="advancedFeatures_img">
                        <img src="/images/homePage/icons/circledchevronright.png" alt="SSL icon">
                    </div>
                    <div class="advancedFeatures_decr">
                        Multi-location checks<br>
                        To avoid possible false-positives we check from different locations.
                    </div>
                </div>
            </div>
            <div class="col-md-5 offset-md-1">
                <div class="advancedFeatures_box">
                    <div class="advancedFeatures_img">
                        <img src="/images/homePage/icons/circledchevronright.png" alt="SSL icon">
                    </div>
                    <div class="advancedFeatures_decr">
                        Share incident updates<br>
                        Create a status page to showcase an uptime and share incident updates.
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="advancedFeatures_box">
                    <div class="advancedFeatures_img">
                        <img src="/images/homePage/icons/circledchevronright.png" alt="SSL icon">
                    </div>
                    <div class="advancedFeatures_decr">
                        On-call<br>
                        Be able to choose people who will recive an alert when your website is broken down.
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
