<div class="boxed">
    <div class="input-info">
        <div spellcheck="false" class="form justify-content-center">
            <form class="" method="get" action="">
    @csrf

    <div class="col-md-12 mt-3">
        <div class="form-group">
            <label for="name">
                {{__('Full name')}}
            </label>
            <input
                name="name"
                type="text"
                class="form-control @error('name') is-invalid @enderror"
                placeholder="{{__('Janis Berzins')}}"
                value="{{old('name')}}"  />
        </div>
    </div>
    <div class="col-md-12 mt-3">
        <div class="form-group">
            <label for="email">
                {{__('Email')}}
            </label>
            <input
                name="email"
                type="email"
                class="form-control @error('email') is-invalid @enderror"
                placeholder="{{__('janis.berzins@inbox.lv')}}"
                value="{{old('email')}}"
            />
        </div>
    </div>
    <div class="col-md-12 mt-3">
        <div class="form-group">
            <label for="message">
                {{__('Message')}}
            </label>
            <textarea
                name="message"
                class="form-control @error('message') is-invalid @enderror"
                placeholder="{{__('Feel free to leave a message')}}"
            >
                {{old('message')}}
            </textarea>
        </div>
    </div>
    <div class="col-md-12">
        <input
            name="Contact us"
            type="submit"
            class="btn btn-primary mt-2"
            value="{{__('Contact us')}}"
        />
    </div>
</form>
        </div>
    </div>
</div>
