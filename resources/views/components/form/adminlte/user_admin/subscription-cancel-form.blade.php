@if ($planName !== 'Free')
<div class="mt-3">
    <hr>

    <p>
        {{ __('Cancels a customer’s subscription immediately. The customer will not be charged again for the subscription however, that any pending invoice items that you’ve created will still be charged for at the end of the period.') }}
    </p>

    <a class="btn btn-danger" href="{{ route('user.settings.subscription.plans.cancel_confirm', ['planName' => $planName]) }}">
        <i class="fas fa-pencil-alt mr-1"></i>
        {{ __("Cancel Subscription") }}
    </a>
</div>
@endif
