<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'WEBcheck') }}</title>

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <!-- Our scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Cookies -->
    <script type="text/javascript" id="cookieinfo"
            src="//cookieinfoscript.com/js/cookieinfo.min.js"
            data-font-family="Open Sans', sans-serif"
            data-bg="#131a26"
            data-fg="#FFFFFF"
            data-link="#CA6D00"
            data-message="{{ __('We use cookies to enhance your experience. By continuing to visit this site you agree to our use of cookies.') }}"
            data-linkmsg="{{ __('More info') }}"
            data-cookie="CookieScript"
            data-text-align="center"
            data-divlink="#FFFFFF"
            data-divlinkbg="#CA6D00"
            data-close-text="{{ __('Got it!') }}">
    </script>

    <!-- Place your kit's code here -->
    <script src="https://kit.fontawesome.com/f53cf4b771.js" crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,600;0,700;1,400;1,600&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/section.css') }}" rel="stylesheet">

    <script src="https://js.stripe.com/v3/"></script>
</head>
<body>
    <div id="app" class="jumbotron vertical-center mb-0" style="background-color: #f8f9fa !important">
        <div class="container">
            <div class="mb-4">
                <a class="icon-block" href="{{ route('user.settings') }}">
                    <i class="fas fa-long-arrow-alt-left fa-2x "></i>
                </a>
            </div>

            <div class="row justify-content-center">
                @foreach($plans as $plan)
                    <div class="col-md-3 m-1">
                        <div class="plan-wrapper">
                            <div class="plan-lable">
                                <strong>{{ __(strtoupper($plan->product->name)) }}</strong>
                            </div>

                            <div class="price-box mb-3">
                                {{ __(":price /month", ['price' => number_format(($plan->amount)/100) . '€']) }}
                            </div>

                            <div class="plan-decription-wrapper mb-3">
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

                            @if (strtoupper($planName) === strtoupper($plan->product->name))
                                <div class="nav-item payBtn OrangeButton">
                                    <a class="nav-link btn btn-orange disabled" style="color: white">
                                        {{ __("Already subscribed") }}
                                    </a>
                                </div>
                            @else
                                <div class="nav-item payBtn OrangeButton">
                                    <a class="nav-link btn btn-orange" href="{{ route('plans.show', ['plan' => $plan->id, 'role' => $plan->product->metadata['RoleID']]) }}">
                                        {{ __("Subscribe now") }}
                                    </a>
                                </div>
                            @endif

                        </div>
                    </div>
                @endforeach
            </div>

            <footer class="my-5 pt-5 text-muted text-center text-small">
                <a class="mb-1" href="https://stripe.com">
                    {{ __("Powered by Stripe") }}
                </a>

                <p class="mb-1">
                    {{ __("© :year. All Rights Reserved.", ['year' => "2021"]) }}
                </p>

                <ul class="list-inline">
                    <li class="list-inline-item">
                        <a href="https://stripe.com/en-lv/privacy">
                            {{ __('Privacy') }}
                        </a>
                    </li>

                    <li class="list-inline-item">
                        <a href="https://stripe.com/en-lv/ssa">
                            {{ __('Terms') }}
                        </a>
                    </li>
                </ul>
            </footer>
        </div>
    </div>
</body>
</html>
