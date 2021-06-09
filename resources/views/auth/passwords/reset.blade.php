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
    {{-- Background image --}}
    <div style="background-image: url({{ URL::asset('/images/background.jpg') }}); background-repeat: no-repeat; background-size: cover; position: relative; overflow: auto; height: 100vh; display: flex; justify-content: center; align-items: center;">
        <div class="container col-lg-8 col-md-12 col-sm-12 margin: auto; width: 60%; padding: 10px;">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        {{-- Form header --}}
                        <div class="card-header text-white" style="background-color: #182232;">
                            {{ __('Reset Password') }}
                        </div>
                        {{-- Ask for data in fiel --}}
                        <div class="card-body">
                            <form method="POST" action="{{ route('password.update') }}">
                                @csrf
                                {{-- Create token change in database --}}
                                <input type="hidden" name="token" value="{{ $token }}">
                                {{-- E-mail adress which need to change the password --}}
                                <div class="form-group row">
                                    <label for="email" class="col-md-4 col-form-label text-md-right">
                                        {{ __('E-Mail Address') }}
                                    </label>
                                    {{-- error message --}}
                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                {{-- Field which requers data (new password) --}}
                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">
                                        {{ __('Password') }}
                                    </label>
                                    {{-- Password do not match --}}
                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                {{-- Field which requers data (repeat new password) --}}
                                <div class="form-group row">
                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">
                                        {{ __('Confirm Password') }}
                                    </label>

                                    <div class="col-md-6">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                </div>
                                {{-- Button, which change password --}}
                                <div class="form-group row mb-0 OrangeButton">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit"  class="mt-2 btn btn-orange text-white" style=" background-color: #FF8A00">
                                            {{ __('Reset Password') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
