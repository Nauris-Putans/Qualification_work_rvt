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
    <script src="{{ asset('js/arrow.js') }}"></script>
    <script src="{{ asset('js/switch.js')}}"></script>
    <script src="{{ asset('js/faq.js')}}"></script>

    <!-- Cookies -->
    <script type="text/javascript" id="cookieinfo"
            src="//cookieinfoscript.com/js/cookieinfo.min.js"
            data-font-family="Open Sans', sans-serif"
            data-bg="#131a26"
            data-fg="#FFFFFF"
            data-link="#CA6D00"
            data-cookie="CookieScript"
            data-text-align="center"
            data-divlink="#FFFFFF"
            data-divlinkbg="#CA6D00"
            data-close-text="Got it!">
    </script>

    <!-- Place your kit's code here -->
    <script src="https://kit.fontawesome.com/f53cf4b771.js" crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,600;0,700;1,400;1,600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/section.css') }}" rel="stylesheet">

    <script src="https://js.stripe.com/v3/"></script>
</head>
<body>
    <div id="app">
        {{-- Navigation bar --}}
        <nav class="navbar navbar-expand-lg sticky-top bg-darkblue shadow-sm d-flex justify-content-between">
            <div class="container">

                <!-- Navbar brand logo -->
                <div class="navbar-nav col-4 align-items-start ">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img src="{{URL::asset('/images/Logo.png')}}" alt="Logo" style="margin-right: 4rem !important;">
                    </a>
                </div>

                <!-- Hamburger aka navbar toggler -->
                <button class="navbar-toggler navbar-dark ml-auto toggler-example align-items-end" type="button" data-toggle="collapse"
                        data-target="#navbarNavDropdown"
                        aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse col-lg-8 col-md-12 col-sm-12" id="navbarNavDropdown">

                    <!-- Middle Of Navbar -->
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <ul class="navbar-nav Sections mx-auto justify-content-center">
                            {{-- Home --}}
                            <li class="nav-item {{ Request::path() == '/' ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('home') }}">
                                    {{ __('Home') }}
                                </a>
                            </li>

                            {{-- Features --}}
                            <li class="nav-item {{ Request::path() == 'features' ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('features') }}">
                                    {{ __('Features') }}
                                </a>
                            </li>

                            {{-- Pricing --}}
                            <li class="nav-item {{ Request::path() == 'pricing' ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('pricing') }}">
                                    {{ __('Pricing') }}
                                </a>
                            </li>

                            {{-- FAQ --}}
                            <li class="nav-item {{ Request::path() == 'faq' ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('faq') }}">
                                    {{ __('FAQ') }}
                                </a>
                            </li>

                            {{-- Contacts --}}
                            <li class="nav-item {{ Request::path() == 'contacts' ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('contacts') }}">
                                   {{ __('Contacts') }}
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav Authentication ml-auto justify-content-center">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item Login">
                                <a class="nav-link" href="{{ route('login') }}">
                                    {{ __('Log in') }}
                                </a>
                            </li>

                            @if (Route::has('register'))
                                <li class="nav-item Register">
                                    <a class="nav-link btn btn-orange" href="{{ route('login') }}">
                                        {{ __('Sign up') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                    {{-- Admin dashboard--}}
                                    @if (!(Laratrust::hasRole('userFree')) && !(Laratrust::hasRole('userPro')) && !(Laratrust::hasRole('userWebmaster')))
                                        <a class="dropdown-item" href="{{ url('/admin/dashboard') }}">
                                            {{ __('Dashboard') }}
                                        </a>

                                    {{-- User dashboard--}}
                                    @else
                                        <a class="dropdown-item" href="{{ url('/user/dashboard') }}">
                                            {{ __('Dashboard') }}
                                        </a>
                                    @endif

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>

                    <!-- Language Dropdown Menu -->
                    <li class="nav-item dropdown Language">
                        @if (App::isLocale('en'))
                            <a class="nav-link" data-toggle="dropdown" href="#">
                                <span class="flag-icon flag-icon-us"></span>
                            </a>

                        @elseif (App::isLocale('lv'))
                            <a class="nav-link" data-toggle="dropdown" href="#">
                                <span class="flag-icon flag-icon-lv"></span>
                            </a>

                        @elseif (App::isLocale('ru'))
                            <a class="nav-link" data-toggle="dropdown" href="#">
                                <span class="flag-icon flag-icon-ru"></span>
                            </a>

                        @else
                            <a class="nav-link" data-toggle="dropdown" href="#">
                                <span class="flag-icon flag-icon-us"></span>
                            </a>
                        @endif

                        {{-- Languages --}}
                        <div class="dropdown-menu dropdown-menu-right p-0">
                            @if (App::isLocale(''))
                                <a href="lang/en" class="dropdown-item {{ App::isLocale('') ? 'active' : '' }}">
                                    <i class="flag-icon flag-icon-us mr-2"></i> {{ __('English') }}
                                </a>

                            @else
                                <a href="lang/en" class="dropdown-item {{ App::isLocale('en') ? 'active' : '' }}">
                                    <i class="flag-icon flag-icon-us mr-2"></i> {{ __('English') }}
                                </a>
                            @endif

                            <a href="lang/lv" class="dropdown-item {{ App::isLocale('lv') ? 'active' : '' }}">
                                <i class="flag-icon flag-icon-lv mr-2"></i> {{ __('Latvian') }}
                            </a>

                            <a href="lang/ru" class="dropdown-item {{ App::isLocale('ru') ? 'active' : '' }}">
                                <i class="flag-icon flag-icon-ru mr-2"></i> {{ __('Russian') }}
                            </a>
                        </div>
                    </li>
                </div>
            </div>
        </nav>

        {{-- Content--}}
        <main>
            @yield('content')
        </main>

        {{-- Footer --}}
        <div class="pt-5 pb-5 footer footer-color">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 col-xs-12 about-company">
                        <h2>
                            {{ __('WEBcheck') }}
                        </h2>

                        <p class="pr-5 text-white-50">
                            {{ __('Monitoring services that allows you to check about your website statistics - Ping, Port, Response time, SSL Certification Check and much more') }}
                        </p>
                    </div>

                    <div class="col-lg-3 col-xs-12 links">
                        <h4 class="mt-lg-0 mt-sm-3">
                            {{ __('Links') }}
                        </h4>

                        <ul class="m-0 p-0">
                            <li>- <a href="/">{{ __('Home') }}</a></li>
                            <li>- <a href="/features">{{ __('Features') }}</a></li>
                            <li>- <a href="/pricing">{{ __('Pricing') }}</a></li>
                            <li>- <a href="/faq">{{ __('FAQ') }}</a></li>
                            <li>- <a href="/contacts">{{ __('Contacts') }}</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-4 col-xs-12 location">
                        <h4 class="mt-lg-0 mt-sm-4">{{ __('Location') }}</h4>
                        <p>{{ __('Krišjāņa Valdemāra iela 1C, Centra rajons, Rīga, LV-1010') }}</p>
                        <p class="mb-0"><i class="fa fa-phone mr-3"></i>{{ __('+371 22222222') }}</p>
                        <p><i class="fa fa-envelope-o mr-3"></i>{{ __('webcheck@gmail.com') }}</p>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col copyright">
                        <p class=""><small class="text-white-50">{{ __("© :year. All Rights Reserved.", ['year' => "2021"]) }}</small></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Arrow who sends back to the top-->
        <a id="back2Top" title="Back to top" href="#">&#10148;</a>
    </div>

    @yield('scripts')
</body>
</html>
