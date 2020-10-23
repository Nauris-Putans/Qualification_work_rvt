<div>
    {{-- Succses message --}}
    @if(session()->has('message'))
        {{$slot}}
        <div class="alert alert-success col-8" style="margin-top: 20px">{{session()->get('message')}}</div>
    @endif

    {{-- Error message --}}
    @if ($errors->any())
        <div class="alert alert-danger col-8" style="margin-top: 20px">
            @foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach
        </div>
    @endif
</div>
