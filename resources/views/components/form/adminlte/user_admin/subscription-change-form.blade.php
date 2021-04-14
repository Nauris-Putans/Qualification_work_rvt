<div class="mt-3">
    <hr>

    <p>
        {{ __('Changes an existing subscription to match new selected plan. When changing prices, we will optionally prorate the price we charge next month to make up for any price changes.') }}
    </p>

    <a class="btn btn-info" href="{{ route('user.settings.subscription.plans', ['planName' => $planName]) }}">
        <i class="fas fa-pencil-alt mr-1"></i>
        {{ __("Change Subscription") }}
    </a>
</div>
