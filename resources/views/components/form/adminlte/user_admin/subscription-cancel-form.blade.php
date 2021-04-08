<form method="POST" action="{{ URL::route('user.settings.personal_info.update', [$hashids->encode($user->id)]) }}" id="subscription-cancel">
    @method('PATCH')
    @csrf

    <div class="mt-3">
        <hr>

        <p>
            {{ __('Cancels a customer’s subscription immediately. The customer will not be charged again for the subscription however, that any pending invoice items that you’ve created will still be charged for at the end of the period.') }}
        </p>

        <button type="submit" class="btn btn-danger">
            <i class="fas fa-pencil-alt mr-1"></i>
            {{ __('Cancel Subscription') }}
        </button>
    </div>
</form>
