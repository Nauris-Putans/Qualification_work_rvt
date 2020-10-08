<div class="boxed">
    <div class="input-info text-white">
        <div spellcheck="false" class="form justify-content-center">
            <form class="" method="get" action="/">
                @csrf

                <div class="col-md-12 mt-3">
                    <div class="form-group">
                        <input
                            name="name"
                            type="text"
                            class="form-control @error('name') is-invalid @enderror"
                            placeholder="{{__('Full name')}}"
                            value="{{old('name')}}"  />
                    </div>
                </div>

                <div class="col-md-12 mt-3">
                    <div class="form-group">
                        <input
                            name="email"
                            type="email"
                            class="form-control @error('email') is-invalid @enderror"
                            placeholder="{{__('Email')}}"
                            value="{{old('email')}}"
                        />
                    </div>
                </div>

                <div class="col-md-12 mt-3">
                    <div class="form-group">
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
