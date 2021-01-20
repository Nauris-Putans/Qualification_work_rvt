<div class="boxed">
    <div class="input-info">
        <div spellcheck="false" class="form justify-content-center">
            <form method="POST" action="{{ URL::route('admin.settings.notification.update', [$hashids->encode($user->id)]) }}" id="personal_info">
                @method('PATCH')
                @csrf

                <div class="col-12 mb-4">
                    <h5>
                        {{ __('Change Notifications here') }}
                    </h5>
                </div>

                <div class="col-12 mt-3">
                    <p>
                        {{ __('Choose how you will receive notifications from us. WEBcheck will send you email or SMS notifications based on your notification settings.') }}
                    </p>

                    {{-- Data table --}}
                    <table class="table table-striped table-bordered dt-responsive nowrap TableStyle col-lg-8 col-md-8 col-sm-8" id="notification-table">
                        <thead class="thead-light">
                        <tr class="CenterTextTable">
                            <th scope="col" style="width: 20%;">{{ __('NOTIFICATION') }}</th>
                            <th scope="col" style="width: 15%;">{{ __('EMAIL') }}</th>
                            <th scope="col" style="width: 15%;">{{ __('SMS') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr class="CenterTextTable">
                                <td>{{ __("Problem") }}</td>
                                <th scope="row">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" name="notifications[]" class="notifications" value="problem_email">
                                    </div>
                                </th>
                                <th scope="row">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" name="notifications[]" class="notifications" value="problem_sms">
                                    </div>
                                </th>
                            </tr>
                            <tr class="CenterTextTable">
                                <td>{{ __("Update") }}</td>
                                <th scope="row">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" name="notifications[]" class="notifications" value="payment_email">
                                    </div>
                                </th>
                                <th scope="row">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" name="notifications[]" class="notifications" value="update_sms">
                                    </div>
                                </th>
                            </tr>
                            <tr class="CenterTextTable">
                                <td>{{ __("Payment") }}</td>
                                <th scope="row">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" name="notifications[]" class="notifications" value="payment_email">
                                    </div>
                                </th>
                                <th scope="row">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" name="notifications[]" class="notifications" value="payment_sms">
                                    </div>
                                </th>
                            </tr>
                        </tbody>
                    </table>

                    <hr>

                    <div class="col-12 mb-4" style="padding-left: 0">
                        <h5>
                            {{ __('Change Notification Destinations here') }}
                        </h5>
                    </div>

                    <div class="row">
                        {{-- Email Address input--}}
                        <div class="col-md-4 form-group">
                            <label for="email">
                                {{ __('Email') }}*
                            </label>
                            <input
                                name="email"
                                id="email"
                                type="text"
                                class="form-control @error('email') is-invalid @enderror"
                                value="{{ $user->email }}"
                            />
                        </div>

                        {{-- Phone Number input--}}
                        <div class="col-md-4 form-group">
                            <label for="mobile_phone">
                                {{ __('Mobile Phone') }}<span id="descr"></span>
                            </label>

                            <input style="display: none"
                                   id="customer_mobile_phone"
                                   type="text"
                                   class="form-control @error('mobile_phone_without_mask') is-invalid @enderror"
                                   name="mobile_phone_without_mask"
                                   value="{{ $user->phone_number }}"
                                   size="25"
                            >

                            <input type="text"
                                   id="mobile_phonecode"
                                   name="mobile_phone"
                                   class="form-control @error('mobile_phone') is-invalid @enderror"
                                   value="{{ $user->phone_number }}"
                            >
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 form-group">
                            <span>
                                <input type="checkbox" name="notification_checkbox" id="notification_checkbox">
                                <label style="font-weight: 400; font-size: 16px;" for="notification_checkbox">
                                    {{ __('Send Invoices and Notifications') }}
                                </label>
                            </span>
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
