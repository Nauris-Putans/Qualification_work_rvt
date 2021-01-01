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

                <div class="col-md-12 mt-3">
                    <p>
                        You can set your billing email address here. It will be used for sending invoices and other billing notifications. If you leave this field empty, your account email will be used by default.
                    </p>

                    <div class="row">
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
