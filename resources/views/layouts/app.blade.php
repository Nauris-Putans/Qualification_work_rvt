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
        <nav class="navbar navbar-expand-md navbar-dark bg-darkblue shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{URL::asset('/images/Logo.png')}}" alt="Logo" class="img-responsive">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                    </ul>

                    <!-- Middle Of Navbar -->
                    <ul class="navbar-nav m-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="/">{{ __('Home') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/features">{{ __('Features') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/pricing">{{ __('Pricing') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/faq">{{ __('FAQ') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/contacts">{{ __('Contacts') }}</a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Log in') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link btn btn-orange" href="{{ route('register') }}">{{ __('Sign up') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main>
            @yield('content')
        </main>

        <div class="pt-5 pb-5 footer footer-color">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 col-xs-12 about-company">
                        <h2>WEBcheck</h2>
                        <p class="pr-5 text-white-50">Monitoring services that allows you to check about
                            your website statistics - Ping, Port, Response time, SSL Certification Check and much more
                        </p>
                    </div>
                    <div class="col-lg-3 col-xs-12 links">
                        <h4 class="mt-lg-0 mt-sm-3">Links</h4>
                        <ul class="m-0 p-0">
                            <li>- <a href="/">Home</a></li>
                            <li>- <a href="/features">Features</a></li>
                            <li>- <a href="/pricing">Pricing</a></li>
                            <li>- <a href="/faq">FAQ</a></li>
                            <li>- <a href="/contacts">Contacts</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-4 col-xs-12 location">
                        <h4 class="mt-lg-0 mt-sm-4">Location</h4>
                        <p>Krišjāņa Valdemāra iela 1C, Centra rajons, Rīga, LV-1010</p>
                        <p class="mb-0"><i class="fa fa-phone mr-3"></i>+371 22222222</p>
                        <p><i class="fa fa-envelope-o mr-3"></i>webcheck@gmail.com</p>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col copyright">
                        <p class=""><small class="text-white-50">© 2020. All Rights Reserved.</small></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
