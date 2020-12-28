<div class="boxed">
    <div class="input-info">
        <div spellcheck="false" class="form justify-content-center">
            <form method="POST" action="{{ URL::route('admin.settings.password_security.update', [$hashids->encode($user->id)]) }}" id="password_secuirty">
                @method('PATCH')
                @csrf

                <div class="col-12 mb-4">
                    <h5>
                        {{ __('Change Password & Security here') }}
                    </h5>
                </div>

                <div class="col-md-12">
                    <div class="row">

                        {{-- Current Password input--}}
                        <div class="col-md-4 form-group">
                            <label for="current_password">
                                {{ __('Current Password') }}*
                            </label>
                            <input
                                name="current_password"
                                type="password"
                                class="form-control @error('current_password') is-invalid @enderror"
                            />
                        </div>

                    </div>
                </div>

                <div class="col-md-12">
                    <div class="row">

                        {{-- New Password input--}}
                        <div class="col-md-4 form-group">
                            <label for="new_password">
                                {{ __('New Password') }}*
                            </label>
                            <input
                                name="new_password"
                                type="password"
                                class="form-control @error('new_password') is-invalid @enderror"
                            />
                        </div>

                    </div>
                </div>

                <div class="col-md-12">
                    <div class="row">

                        {{-- New Confirm Password input--}}
                        <div class="col-md-4 form-group">
                            <label for="new_confirm_password">
                                {{ __('New Confirm Password') }}*
                            </label>
                            <input
                                name="new_confirm_password"
                                type="password"
                                class="form-control @error('new_confirm_password') is-invalid @enderror"
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
