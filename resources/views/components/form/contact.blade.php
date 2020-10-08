<x-alert />
<div class="boxed">
    <div class="input-info text-white">
        <div spellcheck="false" class="form justify-content-center">
            <form method="post" action="/contacts/create">
                @csrf

                {{-- Full name input--}}
                <div class="col-md-12 mt-3">
                    <div class="form-group">
                        <input
                            name="fullname"
                            type="text"
                            class="form-control @error('fullname') is-invalid @enderror"
                            placeholder="{{__('Full name')}}"
                            value="{{old('fullname')}}"  />
                    </div>
                </div>

                {{-- Email input--}}
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

                {{-- Message input--}}
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

                {{-- Contact us button--}}
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
