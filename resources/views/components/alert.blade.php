<div class="text-center align-items-center">
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block" style="margin-bottom: 0 !important;">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
        </div>
    @endif

    @if ($message = Session::get('error'))
        <div class="alert alert-danger alert-block" style="margin-bottom: 0 !important;">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
        </div>
    @endif

    @if ($message = Session::get('warning'))
        <div class="alert alert-warning alert-block" style="margin-bottom: 0 !important;">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
        </div>
    @endif

    @if ($message = Session::get('info'))
        <div class="alert alert-info alert-block" style="margin-bottom: 0 !important;">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger" style="margin-bottom: 0 !important;">
        <button type="button" class="close" data-dismiss="alert">×</button>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </div>
    @endif
</div>
