<div>
    {{-- Succses message --}}
    @if(session()->has('personal_info_message'))
        {{$slot}}
        <div class="alert alert-success">{{session()->get('personal_info_message')}}</div>
    @endif

    {{-- Error message --}}
    @if ($errors->hasBag('personal_info'))
        <div class="alert alert-danger">
            @foreach ($errors->getBag('personal_info')->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </div>
    @endif
</div>
