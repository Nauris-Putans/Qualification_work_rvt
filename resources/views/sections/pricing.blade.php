@extends('layouts.app')

@section('content')
<section class="pricing">
    <div class="container">
        <div class="row">
            <div class="pricing__lable">
                <h1 class="FeaturesPageHeader fade-in align-self-center text-center text-md-center text-white font-weight-bold text-shadow">
                    {{ __("Choose a plan") }}
                </h1>
            </div>
        </div>

        <div class="row justify-content-center">
            @foreach($plans as $plan)
                <div class="col-md-3 m-1">
                    <div class="plan-wrapper">
                        <div class="plan-lable">
                            {{ __(strtoupper($plan->product->name)) }}
                        </div>

                        <div class="price-box">
                            {{ __(":price /month", ['price' => number_format(($plan->amount)/100) . '€']) }}
                        </div>

                        <div class="plan-decription-wrapper">
                            <div class="plan-freature-box">
                                {{ __(":count monitors", ['count' => $plan->product->metadata['Monitors']]) }}
                            </div>

                            <div class="plan-freature-box">
                                {{ __(":time min monitoring interval", ['time' => $plan->product->metadata['Min monitoring interval']]) }}
                            </div>

                            <div class="plan-freature-box">
                                {{ __($plan->product->metadata['Alert']) }}
                            </div>

                            @if(($plan->product->metadata['HTTP(S) monitoring']) == "true")
                                <div class="plan-freature-box">
                                    {{ __('HTTP(S) monitoring') }}
                                </div>
                            @else
                                <div class="plan-freature-box">
                                    {{ __('No HTTP(S) monitoring') }}
                                </div>
                            @endif

                            @if(($plan->product->metadata['Response time monitoring']) == "true")
                                <div class="plan-freature-box">
                                    {{ __('Response time monitoring') }}
                                </div>
                            @else
                                <div class="plan-freature-box">
                                    {{ __('No response time monitoring') }}
                                </div>
                            @endif

                            @if(($plan->product->metadata['Ping monitoring']) == "true")
                                <div class="plan-freature-box">
                                    {{ __('Ping monitoring') }}
                                </div>
                            @else
                                <div class="plan-freature-box">
                                    {{ __('No ping monitoring') }}
                                </div>
                            @endif

                            @if(($plan->product->metadata['Port monitoring']) == "true")
                                <div class="plan-freature-box">
                                    {{ __('Port monitoring') }}
                                </div>
                            @else
                                <div class="plan-freature-box">
                                    {{ __('No port monitoring') }}
                                </div>
                            @endif

                            @if(($plan->product->metadata['Log file']) == "true")
                                <div class="plan-freature-box">
                                    {{ __('Log file') }}
                                </div>
                            @else
                                <div class="plan-freature-box">
                                    {{ __('No log file') }}
                                </div>
                            @endif

                            @if(($plan->product->metadata['SSL check']) == "true")
                                <div class="plan-freature-box">
                                    {{ __('SSL check') }}
                                </div>
                            @else
                                <div class="plan-freature-box">
                                    {{ __('No SSL check') }}
                                </div>
                            @endif
                        </div>

                        @if(($plan->product->metadata['Button']) == "grey")
                            <div class="nav-item payBtn GreyButton">
                                @if(Auth::user() == null)
                                    <a class="nav-link btn btn-gray" href="{{ route('login') }}">
                                        {{ __("Start monitoring") }}
                                    </a>
                                @else
                                    @if (!(Laratrust::hasRole('userFree')) && !(Laratrust::hasRole('userPro')) && !(Laratrust::hasRole('userWebmaster')))
                                        {{-- Admin dashboard--}}
                                        <a class="nav-link btn btn-gray" href="{{ url('/admin/dashboard') }}">
                                            {{ __("Start monitoring") }}
                                        </a>
                                    @else
                                    {{-- User dashboard--}}
                                        <a class="nav-link btn btn-gray" href="{{ url('/user/dashboard') }}">
                                            {{ __("Start monitoring") }}
                                        </a>
                                    @endif
                                @endif
                            </div>
                        @elseif(($plan->product->metadata['Button']) == "orange")
                            <div class="nav-item payBtn OrangeButton">
                                <a class="nav-link btn btn-orange" href="{{ route('plans.show', ['plan' => $plan->id, 'role' => $plan->product->metadata['RoleID']]) }}">
                                    {{ __("Subscribe now") }}
                                </a>
                            </div>
                        @else
                            <div class="nav-item payBtn GreyButton" style="width: 50%" >
                                <a class="nav-link btn btn-gray" href="{{ route('contacts') }}">
                                    {{ __("Contact us") }}
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
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
