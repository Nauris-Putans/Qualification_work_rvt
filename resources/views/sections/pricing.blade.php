@extends('layouts.app')

@section('content')
<section class="pricing">
    <div class="container">
        <div class="row">
            <div class="pricing__lable">
                Flawless plans that suit you
            </div>
        </div>
        <div class="row justify-content-center" >
            <div class="col-md-3 m-1">
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
            <div class="col-md-3 m-1">
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
            <div class="col-md-3 m-1">
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
            
        </div>

        <div class="row justify-content-center">
            <div class="col-md-9 m-1 enterprise-padding">
                <div class="plan-wrapper">
                    <div class="plan-lable">ENTERPRISE</div>
                    <div class="plan-enterprise-decription-wrapper" style="height: 110px">
                        <div class="plan-freature-box w-80">Need something special? No problem,
                             we can handle a custom number of monitors and check-intervals.
                        </div>
                    </div>
                    <div class="nav-item payBtn" style="width: 50%" >
                        <a class="nav-link btn btn-gray" href="{{ route('login') }}">{{ __('Contact us') }}</a>
                    </div>
                </div>
            </div>
        </div>

    </div>

</section>
@endsection
