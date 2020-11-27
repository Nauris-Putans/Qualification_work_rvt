{{-- Succses message --}}
@if(session()->has('message'))
    {{$slot}}
    <div class="alert alert-success col-8 offset-2 mt-2 mb-5">{{session()->get('message')}}</div>
@endif

{{-- Error message --}}
@if ($errors->any())
    <div class="alert alert-danger col-8 offset-2 mt-2 mb-5">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </div>
@endif
