@extends('layouts.app')

@section('content')

    <section class="homeIntroduce">
        <div class="container">
            <h1>BE UPTIME WITH WEBCHECK</h1>
            <div class="titleDecr">
                Monitoring services that allows you to <br> check about your website statistics -<br> Ping, Port, Response time, SSL<br> Certification Check and much more
            </div>
            <button type="button" href="#" class="btn btn-warning">TRY IT FREE</button>
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
                            <a href="#">more</a>
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
                            <a href="#">more</a>
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
                            <a href="#">more</a>
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
            <h2>WEBSITE MONITORING PACKAGES</h2>
            <div class="row">
                <div class="col-md-4 offset-md-2">
                    <div class="package">
                        <div class="package_title">
                            FREE
                        </div>
                        <div class="package_line"></div>
                        <div class="package_decr">
                            <img src="{{ URL::asset('/images/homePage/icons/checkmark.png') }}" alt="check mark icon" class="package_decr_checkmarkicon">
                            <div class="package_decr_text">
                                5 min checks
                            </div>
                            <img src="{{ URL::asset('/images/homePage/icons/help.png') }}" alt="help icon" class="package_decr_helpicon">
                        </div>
                        <div class="package_decr">
                            <img src="{{ URL::asset('/images/homePage/icons/checkmark.png') }}" alt="check mark icon" class="package_decr_checkmarkicon">
                            <div class="package_decr_text">
                                10 monitors
                            </div>
                            <img src="{{ URL::asset('/images/homePage/icons/help.png') }}" alt="help icon" class="package_decr_helpicon">
                        </div>
                        <div class="package_decr">
                            <img src="{{ URL::asset('/images/homePage/icons/checkmark.png') }}" alt="check mark icon" class="package_decr_checkmarkicon">
                            <div class="package_decr_text">
                                Email alerts
                            </div>
                            <img src="{{ URL::asset('/images/homePage/icons/help.png') }}" alt="help icon" class="package_decr_helpicon">
                        </div>
                        <div class="package_decr">
                            <img src="{{ URL::asset('/images/homePage/icons/checkmark.png') }}" alt="check mark icon" class="package_decr_checkmarkicon">
                            <div class="package_decr_text">
                                HTTP(S) monitoring
                            </div>
                            <img src="{{ URL::asset('/images/homePage/icons/help.png') }}" alt="help icon" class="package_decr_helpicon">
                        </div>
                        <div class="package_decr">
                            <img src="{{ URL::asset('/images/homePage/icons/checkmark.png') }}" alt="check mark icon" class="package_decr_checkmarkicon">
                            <div class="package_decr_text">
                                Response time monitoring
                            </div>
                            <img src="{{ URL::asset('/images/homePage/icons/help.png') }}" alt="help icon" class="package_decr_helpicon">
                        </div>
                        <div class="package_decr">
                            <img src="{{ URL::asset('/images/homePage/icons/checkmark.png') }}" alt="check mark icon" class="package_decr_checkmarkicon">
                            <div class="package_decr_text">
                                Ping monitoring
                            </div>
                            <img src="{{ URL::asset('/images/homePage/icons/help.png') }}" alt="help icon" class="package_decr_helpicon">
                        </div>
                        <div class="package_decr">
                            <img src="{{ URL::asset('/images/homePage/icons/checkmark.png') }}" alt="check mark icon" class="package_decr_checkmarkicon">
                            <div class="package_decr_text">
                                Port monitoring
                            </div>
                            <img src="{{ URL::asset('/images/homePage/icons/help.png') }}" alt="help icon" class="package_decr_helpicon">
                        </div>
                        <div class="package_decr">
                            <img src="{{ URL::asset('/images/homePage/icons/checkmark.png') }}" alt="check mark icon" class="package_decr_checkmarkicon">
                            <div class="package_decr_text">
                                History (1 month)
                            </div>
                            <img src="{{ URL::asset('/images/homePage/icons/help.png') }}" alt="help icon" class="package_decr_helpicon">
                        </div>
                    </div>


                    <div class="package_btn">
                        Get it now
                    </div>
                </div>



                <div class="col-md-4 offset-md-1">
                    <div class="package">
                        <div class="package_title">
                            Pro (10$/month)
                        </div>
                        <div class="package_line"></div>
                        <div class="package_decr">
                            <img src="{{ URL::asset('/images/homePage/icons/checkmark.png') }}" alt="check mark icon" class="package_decr_checkmarkicon">
                            <div class="package_decr_text">
                                1 min checks
                            </div>
                            <img src="{{ URL::asset('/images/homePage/icons/help.png') }}" alt="help icon" class="package_decr_helpicon">
                        </div>
                        <div class="package_decr">
                            <img src="{{ URL::asset('/images/homePage/icons/checkmark.png') }}" alt="check mark icon" class="package_decr_checkmarkicon">
                            <div class="package_decr_text">
                                50 monitors
                            </div>
                            <img src="{{ URL::asset('/images/homePage/icons/help.png') }}" alt="help icon" class="package_decr_helpicon">
                        </div>
                        <div class="package_decr">
                            <img src="{{ URL::asset('/images/homePage/icons/checkmark.png') }}" alt="check mark icon" class="package_decr_checkmarkicon">
                            <div class="package_decr_text">
                                SMS and Email alerts
                            </div>
                            <img src="{{ URL::asset('/images/homePage/icons/help.png') }}" alt="help icon" class="package_decr_helpicon">
                        </div>
                        <div class="package_decr">
                            <img src="{{ URL::asset('/images/homePage/icons/checkmark.png') }}" alt="check mark icon" class="package_decr_checkmarkicon">
                            <div class="package_decr_text">
                                HTTP(S) monitoring
                            </div>
                            <img src="{{ URL::asset('/images/homePage/icons/help.png') }}" alt="help icon" class="package_decr_helpicon">
                        </div>
                        <div class="package_decr">
                            <img src="{{ URL::asset('/images/homePage/icons/checkmark.png') }}" alt="check mark icon" class="package_decr_checkmarkicon">
                            <div class="package_decr_text">
                                Response time monitoring
                            </div>
                            <img src="{{ URL::asset('/images/homePage/icons/help.png') }}" alt="help icon" class="package_decr_helpicon">
                        </div>
                        <div class="package_decr">
                            <img src="{{ URL::asset('/images/homePage/icons/checkmark.png') }}" alt="check mark icon" class="package_decr_checkmarkicon">
                            <div class="package_decr_text">
                                Ping monitoring
                            </div>
                            <img src="{{ URL::asset('/images/homePage/icons/help.png') }}" alt="help icon" class="package_decr_helpicon">
                        </div>
                        <div class="package_decr">
                            <img src="{{ URL::asset('/images/homePage/icons/checkmark.png') }}" alt="check mark icon" class="package_decr_checkmarkicon">
                            <div class="package_decr_text">
                                Port monitoring
                            </div>
                            <img src="{{ URL::asset('/images/homePage/icons/help.png') }}" alt="help icon" class="package_decr_helpicon">
                        </div>
                        <div class="package_decr">
                            <img src="{{ URL::asset('/images/homePage/icons/checkmark.png') }}" alt="check mark icon" class="package_decr_checkmarkicon">
                            <div class="package_decr_text">
                                History (unlimited)
                            </div>
                            <img src="{{ URL::asset('/images/homePage/icons/help.png') }}" alt="help icon" class="package_decr_helpicon">
                        </div>
                        <div class="package_decr">
                            <img src="{{ URL::asset('/images/homePage/icons/checkmark.png') }}" alt="check mark icon" class="package_decr_checkmarkicon">
                            <div class="package_decr_text">
                                Status page
                            </div>
                            <img src="{{ URL::asset('/images/homePage/icons/help.png') }}" alt="help icon" class="package_decr_helpicon">
                        </div>
                        <div class="package_decr">
                            <img src="{{ URL::asset('/images/homePage/icons/checkmark.png') }}" alt="check mark icon" class="package_decr_checkmarkicon">
                            <div class="package_decr_text">
                                SSL Certification Check
                            </div>
                            <img src="{{ URL::asset('/images/homePage/icons/help.png') }}" alt="help icon" class="package_decr_helpicon">
                        </div>
                    </div>
                    <div class="package_btn">
                        Get it now
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
