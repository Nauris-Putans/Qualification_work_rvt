<div>
    {{-- Succses message --}}
    @if(session()->has('message'))
        {{$slot}}
        <div class="alert alert-success col-8 offset-2" style="margin-top: 40px">{{session()->get('message')}}</div>
    @endif

    {{-- Error message --}}
    @if ($errors->any())
        <div class="alert alert-danger col-8 offset-2" style="margin-top: 40px">
            @foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach
        </div>
    @endif
</div>
