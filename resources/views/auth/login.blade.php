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
    <script src="{{ asset('js/switch.js')}}"></script>

    <!-- Place your kit's code here -->
    <script src="https://kit.fontawesome.com/f53cf4b771.js" crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,600;0,700;1,400;1,600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div style="background-image: url({{ URL::asset('/images/background.jpg') }}); background-repeat: no-repeat; background-size: cover; position: relative; overflow: auto; height: 100vh; display: flex; justify-content: center; align-items: center;">

        <section class="LoginForm col-lg-8 col-md-12 col-sm-12">
            <div class="container" id="container">
                <div class="form-container sign-up-container">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
        
                        <h1>Create Account</h1>
        
                        <input id="signup_name" type="text" class="form-control @error('signup_name') is-invalid @enderror" name="signup_name" value="{{ old('signup_name') }}" required autocomplete="signup_name" autofocus placeholder="{{ __('Name') }}">
                        @error('signup_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
        
                        <input id="signup_email" type="email" class="form-control @error('signup_email') is-invalid @enderror" name="signup_email" value="{{ old('signup_email') }}" required autocomplete="signup_email" placeholder="{{ __('E-Mail Address') }}">
                        @error('signup_email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
        
                        <input id="signup_password" type="password" class="form-control @error('signup_password') is-invalid @enderror" name="signup_password" required autocomplete="signup_new-password" placeholder="{{ __('Password') }}">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
        
                        <input id="signup_password-confirm" type="password" class="form-control" name="signup_password_confirmation" required autocomplete="signup_new-password" placeholder="{{ __('Confirm Password') }}">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Sign up') }}
                        </button>
                    </form>
                </div>
        
                <div class="form-container sign-in-container">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        
                        
                            <h1>Sign in</h1>
                            <input id="login_email" type="email" class="form-control @error('login_email') is-invalid @enderror" name="login_email" value="{{ old('login_email') }}" required autocomplete="login_email" autofocus placeholder="{{ __('E-Mail Address') }}">
            
                            @error('login_email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        
        
                        <input id="login_password" type="password" class="form-control @error('login_password') is-invalid @enderror" name="login_password" required autocomplete="current-password" placeholder="{{ __('Password') }}">
                        @error('login_password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                        
                    <div class="LoginCheckBox">
                        <div class="form-group">
                            <div class="form-check">
                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            </div>
                        </div>
                    </div>
        
                        <button type="submit" class="btn btn-primary">
                            {{ __('Log in') }}
                        </button>
        
                        
                    </form>
                </div>

                <div class="overlay-container">
                    <div class="overlay">
                        <div class="overlay-panel overlay-left">
                            <h1>Alreay have an account?</h1>
                            <p>Easily log in here and continue your monitoring's journey!</p>
                            <button class="ghost" id="signIn">Sign In</button>
                        </div>
                        <div class="overlay-panel overlay-right">
                            <h1>Hello, Visitor!</h1>
                            <p>You steal don't have an account? Easily register and start your jouney in monitoring!</p>
                            <button class="ghost" id="signUp">Sign Up</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</body>
</html>
