<div class="boxed">
    <div class="input-info">
        <div spellcheck="false" class="form justify-content-center">
            <form method="post" action="/contacts/create" id="personal_info">
                <x-alertAdmin />
                @csrf

                <div class="col-12 mb-4">
                    <h5>
                        Change Personal Information here
                    </h5>
                </div>

                <div class="col-md-12 mt-3">
                    <div class="row">

                        {{-- Full Name input--}}
                        <div class="col-md-4 form-group">
                            <label for="fullname">
                                {{ __('Full Name') }}*
                            </label>
                            <input
                                name="fullname"
                                type="text"
                                class="form-control @error('fullname') is-invalid @enderror"
                                value="{{ old('fullname') }}"
                            />
                        </div>

                        {{-- Email Address input--}}
                        <div class="col-md-4 form-group">
                            <label for="email-address">
                                {{ __('Email Address') }}*
                            </label>
                            <input
                                name="email-address"
                                type="text"
                                class="form-control @error('email-address') is-invalid @enderror"
                                value="{{ old('email-address') }}"
                            />
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row">

                        {{-- Phone Number input--}}
                        <div class="col-md-4 form-group">
                            @if(App::isLocale('en'))
                                <label for="phone">Phone number (England)</label>
                                <input type="text" class="form-control" id="phone" name="phone" data-inputmask="'mask': '+44 999 99 999'">
                            @endif

                            @if(App::isLocale('lv'))
                                <label for="phone">Phone number (Latvian)</label>
                                <input type="text" class="form-control" id="phone" name="phone" data-inputmask="'mask': '+371 999 99 999'">
                            @endif

                            @if(App::isLocale('ru'))
                                <label for="phone">Phone number (Russian)</label>
                                <input type="text" class="form-control" id="phone" name="phone" data-inputmask="'mask': '+7 999 99 999'">
                            @endif
                        </div>

                        {{-- Gender input --}}
                        <div class="col-md-4 form-group">
                            <label for="gender">
                                {{ __('Gender') }}
                            </label>
                            <select class="form-control @error('type') is-invalid @enderror" name="gender" form="personal_info">
                                <option hidden disabled selected value></option>
                                <option value="male">{{ __('Male') }}</option>
                                <option value="female">{{ __('Female') }}</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row">

                        {{-- Birthday input --}}
                        <div class="col-md-4 form-group date" data-provide="datepicker">
                            <label for="birthday">
                                {{ __('Birthday') }}
                            </label>
                            <input name="birthday" type="text" class="form-control">
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                            </div>
                        </div>

                        {{-- Country input --}}
                        <div class="col-md-4 form-group">
                            <label for="country">
                                {{ __('Country') }}
                            </label>
                            <select class="form-control @error('country') is-invalid @enderror" name="country" form="personal_info">
                                <option hidden disabled selected value></option>
                                <option value="male">{{ __('Male') }}</option>
                                <option value="female">{{ __('Female') }}</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="row">
                        {{-- City input --}}
                        <div class="col-md-4 form-group">
                            <label for="city">
                                {{ __('City') }}
                            </label>
                            <select class="form-control @error('city') is-invalid @enderror" name="city" form="personal_info">
                                <option hidden disabled selected value></option>
                                <option value="male">{{ __('Male') }}</option>
                                <option value="female">{{ __('Female') }}</option>
                            </select>
                        </div>
                    </div>
                </div>

                {{-- Save Changes button--}}
                <div class="col-md-12 justify-content-center mt-2 mb-5">
                    <button type="submit" class="btn btn-info">
                        {{ __('Save Changes') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
