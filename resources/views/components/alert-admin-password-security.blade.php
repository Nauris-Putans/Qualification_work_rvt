<div>
    {{-- Succses message --}}
    @if(session()->has('password_security_message'))
        {{$slot}}
        <div class="alert alert-success">{{session()->get('password_security_message')}}</div>
    @endif

    {{-- Error message --}}
    @if ($errors->hasBag('password_security'))
        <div class="alert alert-danger">
            @foreach ($errors->getBag('password_security')->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </div>
    @endif
</div>
