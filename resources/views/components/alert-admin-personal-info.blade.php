<div>
    {{-- Succses message --}}
    @if(session()->has('image_message'))
        {{$slot}}
        <div class="alert alert-success">{{session()->get('image_message')}}</div>
    @endif

    {{-- Error message --}}
    @if ($errors->hasBag('image'))
        <div class="alert alert-danger">
            @foreach ($errors->getBag('image')->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </div>
    @endif
</div>
