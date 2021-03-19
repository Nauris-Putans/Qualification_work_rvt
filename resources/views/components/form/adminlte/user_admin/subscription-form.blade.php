<div class="boxed">
    <div class="input-info">
        <div spellcheck="false" class="form justify-content-center">
            <form method="POST" action="{{ URL::route('user.settings.personal_info.update', [$hashids->encode($user->id)]) }}" id="personal_info">
                @method('PATCH')
                @csrf

                <div class="col-12 mb-4">
                    <h5>
                        {{ __('Change :attribute here', ['attribute' => __("Subscription")]) }}
                    </h5>
                </div>

                <div class="col-12 mt-3">
                    <div class="row">
                        <div class="card col-sm-12 col-md-6 col-lg-3 text-center mr-3">
                            <div class="card-body">
                                <h4 class="card-title text-muted" style="float: none;">{{ __('Current subscription') }}</h4>

                                @if ($user->asStripeCustomer()->subscriptions->data[0]->metadata['Plan name'] === null)
                                    <h5 class="card-text"><strong>{{ __('none') }}</strong></h5>
                                @else
                                    <h5 class="card-text"><strong>{{ $user->asStripeCustomer()->subscriptions->data[0]->metadata['Plan name'] . " - " . __('plan') }}</strong></h5>
                                @endif

                            </div>
                        </div>

                        <div class="card col-sm-12 col-md-6 col-lg-3 text-center">
                            <div class="card-body">
                                <h4 class="card-title text-muted" style="float: none;">{{ __('Next billing date') }}</h4>

                                @if ($timestamp === null)
                                    <h5 class="card-text"><strong>{{ __('none') }}</strong></h5>
                                @else
                                    <h5 class="card-text"><strong>{{ strftime("%B %e, %Y", strtotime($timestamp)) }}</strong></h5>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
