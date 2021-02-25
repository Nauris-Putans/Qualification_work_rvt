<div class="boxed">
    <div class="input-info">
        <div spellcheck="false" class="form justify-content-center">
            <form method="POST" action="{{ URL::route('user.settings.personal_info.update', [$hashids->encode($user->id)]) }}" id="personal_info">
                @method('PATCH')
                @csrf

                <div class="col-12 mb-4">
                    <h5>
                        {{ __('Change :attribute here', ['attribute' => __("Personal Information")]) }}
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
                            <select class="form-control selectpicker @error('gender') is-invalid @enderror" data-style="CountrySelect" data-size="10" name="gender" form="personal_info">
                                <option disabled selected data-tokens="{{ $user->gender }}" value="{{ $user->gender }}">
                                    {{ __($user->gender) }}
                                </option>
                                <option data-tokens="{{ __('Male') }}" value="male">
                                    {{ __('Male') }}
                                </option>
                                <option data-tokens="{{ __('Female') }}" value="female">
                                    {{ __('Female') }}
                                </option>
                            </select>
                        </div>

                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row">

                        {{-- Birthday input --}}
                        <div class="col-md-4 form-group">
                            <label for="birthday">
                                {{ __('Birthday') }}
                            </label>
                            <input name="birthday"
                                    type="text"
                                    class="form-control @error('birthday') is-invalid @enderror datepicker"

                                    @if($user->birthday != null)
                                        value="{{ date('d/m/Y', strtotime($user->birthday)) }}"
                                    @else
                                        value=""
                                    @endif
                                   style="padding: .375rem .75rem;"
                            >
                        </div>

                        {{-- Country input --}}
                        <div class="col-md-4 form-group">
                            <label for="country">
                                {{ __('Country') }}
                            </label>
                            <select class="form-control selectpicker @error('country') is-invalid @enderror" data-live-search="true" data-style="CountrySelect" data-size="10" id="countryList" name="country" form="personal_info">
                                @if($countryName != null)
                                    <option disabled selected data-tokens="{{ __($countryName->name) }}" value="{{ $countryName->name }}">{{ __($countryName->name) }}</option>
                                @else
                                    <option disabled selected data-tokens="" value=""></option>
                                @endif

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

                {{-- Hidden birthday input--}}
                <div style="display: none">
                    <input name="birthday_old" value="{{ date('d/m/Y', strtotime($user->birthday)) }}"/>
                </div>

                {{-- Hidden gender input--}}
                <div style="display: none">
                    <input name="gender_old" value="{{ $user->gender }}"/>
                </div>

                {{-- Hidden country input--}}
                <div style="display: none">
                    @if($countryName != null)
                        <input name="country_old" value="{{ $countryName->name }}"/>
                    @else
                        <input name="country_old" value=""/>
                    @endif
                </div>

                {{-- Hidden city input--}}
                <div style="display: none">
                    <input name="city_old" value="{{ $user->city }}"/>
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
