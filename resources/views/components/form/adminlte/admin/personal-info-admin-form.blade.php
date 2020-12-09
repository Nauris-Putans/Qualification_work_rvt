<div class="boxed">
    <div class="input-info">
        <div spellcheck="false" class="form justify-content-center">
            <form method="POST" action="{{ URL::route('admin.settings.personal_info.update', [$hashids->encode($user->id)]) }}" id="personal_info">
                @method('PATCH')
                @csrf

                <div class="col-12 mb-4">
                    <h5>
                        {{ __('Change Personal Information here') }}
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
                                value="{{ $user->name }}"
                            />
                        </div>

                        {{-- Email Address input--}}
                        <div class="col-md-4 form-group">
                            <label for="email_address">
                                {{ __('Email') }}*
                            </label>
                            <input
                                name="email_address"
                                id="email_address"
                                type="text"
                                class="form-control @error('email_address') is-invalid @enderror"
                                value="{{ $user->email }}"
                            />
                        </div>

                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row">

                        {{-- Phone Number input--}}
                        <div class="col-md-4 form-group">
                            <label for="phone">
                                {{ __('Phone number') }}<span id="descr"></span>
                            </label>

                            <input style="display: none"
                                   type="text"
                                   class="form-control"
                                   name="phone_without_mask"
                                   id="customer_phone"
                                   value="{{ $user->phone_number }}"
                                   size="25"
                            >
                            <input type="text"
                                   class="form-control"
                                   name="phone"
                                   id="phonecode"
                                   value="{{ $user->phone_number }}"
                            >
                        </div>

                        {{-- Gender input --}}
                        <div class="col-md-4 form-group">
                            <label for="gender">
                                {{ __('Gender') }}
                            </label>
                            <select class="form-control selectpicker @error('type') is-invalid @enderror" data-live-search="true" data-style="CountrySelect" name="gender" form="personal_info">
                                <option disabled selected data-tokens="{{ $user->gender }}" value="{{ $user->gender }}" @if (old('gender') == $user->gender) {{ 'selected' }} @endif>{{ __($user->gender) }}</option>
                                <option data-tokens="{{ __('Male') }}" value="male">{{ __('Male') }}</option>
                                <option data-tokens="{{ __('Female') }}" value="female">{{ __('Female') }}</option>
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
                            <input name="birthday" type="text" class="form-control" value="{{ date('m/d/Y', strtotime($user->birthday)) }}">
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                            </div>
                        </div>

                        {{-- Country input --}}
                        <div class="col-md-4 form-group">
                            <label for="country">
                                {{ __('Country') }}
                            </label>
                            <select class="form-control selectpicker @error('type') is-invalid @enderror" data-live-search="true" data-style="CountrySelect" data-size="10" id="countryList" name="country" form="personal_info">
                                <option disabled selected data-tokens="{{ __($user->country) }}" value="{{ $user->country }}">{{ __($user->country) }}</option>
                                @foreach ($countries as $country)
                                    <option phonecode="{{ $country->dial_code }}"
                                        value="{{ $country->name }}"
                                        data-tokens="{{ __($country->name) }}"
                                        id="shop-country">{{ __($country->name) }}
                                    </option>
                                @endforeach
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
                            <input
                                name="city"
                                id="city"
                                type="text"
                                class="form-control @error('city') is-invalid @enderror"
                                value="{{ $user->city }}"
                            />
                        </div>

                    </div>
                </div>

                {{-- Save Changes button--}}
                <div class="col-md-12 justify-content-center mt-2 mb-2">
                    <button type="submit" id="bnt_save" class="btn btn-info">
                        <i class="fas fa-pencil-alt mr-1"></i>
                        {{ __('Save Changes') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
