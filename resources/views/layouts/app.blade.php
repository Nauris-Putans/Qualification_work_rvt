<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'WEBcheck') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="{{ asset('js/arrow.js') }}"></script>

    <!-- Place your kit's code here -->
    <script src="https://kit.fontawesome.com/f53cf4b771.js" crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,600;0,700;1,400;1,600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        {{-- Navigation bar --}}
        <nav class="navbar navbar-expand-lg sticky-top bg-darkblue shadow-sm">
            <div class="container">

                <!-- Navbar brand logo -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{URL::asset('/images/Logo.png')}}" alt="Logo" style="margin-right: 4rem !important;">
                </a>

                <!-- Hamburger aka navbar toggler -->
                <button class="navbar-toggler navbar-dark ml-auto toggler-example" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Middle Of Navbar -->
                    <ul class="navbar-nav Sections mx-auto justify-content-center">
                        <li class="nav-item {{ Request::path() == '/' ? 'active' : '' }}">
                            <a class="nav-link" href="{{ url('/') }}">
                                @lang('Home')
                            </a>
                        </li>

                        <li class="nav-item {{ Request::path() == 'features' ? 'active' : '' }}">
                            <a class="nav-link" href="{{ url('/features') }}">
                                @lang('Features')
                            </a>
                        </li>

                        <li class="nav-item {{ Request::path() == 'pricing' ? 'active' : '' }}">
                            <a class="nav-link" href="{{ url('/pricing') }}">
                                @lang('Pricing')
                            </a>
                        </li>

                        <li class="nav-item {{ Request::path() == 'faq' ? 'active' : '' }}">
                            <a class="nav-link" href="{{ url('/faq') }}">
                                @lang('FAQ')
                            </a>
                        </li>

                        <li class="nav-item {{ Request::path() == 'contacts' ? 'active' : '' }}">
                            <a class="nav-link" href="{{ url('/contacts') }}">
                                @lang('Contacts')
                            </a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav Authentication ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item Login">
                                <a class="nav-link" href="{{ route('login') }}">
                                    @lang('Log in')
                                </a>
                            </li>

                            @if (Route::has('register'))
                                <li class="nav-item Register">
                                    <a class="nav-link btn btn-orange" href="{{ route('register') }}">
                                        @lang('Sign up')
                                    </a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    {{-- Admin dashboard--}}
                                    @if (Laratrust::hasRole('admin'))
                                        <a class="dropdown-item" href="{{ url('/admin/dashboard') }}">
                                            @lang('Dashboard')
                                        </a>
                                    @endif

                                    {{-- User Free dashboard--}}
                                    @if (Laratrust::hasRole('userFree'))
                                        <a class="dropdown-item" href="{{ url('/dashboard') }}">
                                            @lang('Dashboard')
                                        </a>
                                    @endif

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        @lang('Logout')
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
                        @if (Session::get('locale') == 'us')
                            <a class="nav-link" data-toggle="dropdown" href="#">
                                <span class="flag-icon flag-icon-us"></span>
                            </a>

                        @elseif (Session::get('locale') == 'lv')
                            <a class="nav-link" data-toggle="dropdown" href="#">
                                <span class="flag-icon flag-icon-lv"></span>
                            </a>

                        @elseif (Session::get('locale') == 'ru')
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

                            @if (Session::get('locale') == '')
                                <a href="locale/us" class="dropdown-item {{ Session::get('locale') == '' ? 'active' : '' }}">
                                    <i class="flag-icon flag-icon-us mr-2"></i> @lang('English')
                                </a>

                            @else
                                <a href="locale/us" class="dropdown-item {{ Session::get('locale') == 'us' ? 'active' : '' }}">
                                    <i class="flag-icon flag-icon-us mr-2"></i> @lang('English')
                                </a>
                            @endif

                            <a href="locale/lv" class="dropdown-item {{ Session::get('locale') == 'lv' ? 'active' : '' }}">
                                <i class="flag-icon flag-icon-lv mr-2"></i> @lang('Latvian')
                            </a>

                            <a href="locale/ru" class="dropdown-item {{ Session::get('locale') == 'ru' ? 'active' : '' }}">
                                <i class="flag-icon flag-icon-ru mr-2"></i> @lang('Russian')
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
                        <h2>WEBcheck</h2>
                        <p class="pr-5 text-white-50">@lang('Monitoring services that allows you to check about your website statistics - Ping, Port, Response time, SSL Certification Check and much more')
                        </p>
                    </div>
                    <div class="col-lg-3 col-xs-12 links">
                        <h4 class="mt-lg-0 mt-sm-3">
                            @lang('Links')
                        </h4>
                        <ul class="m-0 p-0">
                            <li>- <a href="/">@lang('Home')</a></li>
                            <li>- <a href="/features">@lang('Features')</a></li>
                            <li>- <a href="/pricing">@lang('Pricing')</a></li>
                            <li>- <a href="/faq">@lang('FAQ')</a></li>
                            <li>- <a href="/contacts">@lang('Contacts')</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-4 col-xs-12 location">
                        <h4 class="mt-lg-0 mt-sm-4">@lang('Location')</h4>
                        <p>Krišjāņa Valdemāra iela 1C, Centra rajons, Rīga, LV-1010</p>
                        <p class="mb-0"><i class="fa fa-phone mr-3"></i>+371 22222222</p>
                        <p><i class="fa fa-envelope-o mr-3"></i>webcheck@gmail.com</p>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col copyright">
                        <p class=""><small class="text-white-50">@lang('© 2020. All Rights Reserved.')</small></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Arrow who sends back to the top-->
        <a id="back2Top" title="Back to top" href="#">&#10148;</a>
    </div>
</body>
</html>
