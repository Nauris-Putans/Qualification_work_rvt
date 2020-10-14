@extends('layouts.app')

@section('content')
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

{{-- <section class="FQA">
    <div class="container">
        <h2>Frequently Asked Questions</h2>
        <div class="FQA_line"></div>
        <div class="row">
            <div class="col-md-5 offset-md-1">
                <div class="FQA_box">
                    <div class="FQA_titlebox">
                        Can I cancel my plan?
                    </div>
                    <div class="FQA_boxdecr">
                        You can cancel your subscription any time from your account and let it expire back to the Free Plan.
                    </div>
                    <a href="/faq">more</a>
                </div>
            </div>
            <div class="col-md-5 ">
                <div class="FQA_box">
                    <div class="FQA_titlebox">
                        How can I pay?
                    </div>
                    <div class="FQA_boxdecr">
                        We offer payments via Credit Card and PayPal.
                    </div>
                    <a href="/faq">more</a>
                </div>
            </div>
        </div>
    </div>
</section> --}}
@endsection
