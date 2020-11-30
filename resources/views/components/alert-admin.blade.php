<div>
    {{-- Succses message --}}
    @if(session()->has('message'))
        {{$slot}}
        <div class="alert alert-success">{{session()->get('message')}}</div>
    @endif

    {{-- Error message --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach
        </div>
    @endif
</div>
