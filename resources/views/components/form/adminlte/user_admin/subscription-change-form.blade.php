<form method="POST" action="{{ URL::route('user.settings.personal_info.update', [$hashids->encode($user->id)]) }}" id="subscription-change">
    @method('PATCH')
    @csrf

    <div class="mt-3">
        <hr>

        <p>
            {{ __('Changes an existing subscription to match new selected plan. When changing prices, we will optionally prorate the price we charge next month to make up for any price changes.') }}
        </p>

        <button type="submit" class="btn btn-info">
            <i class="fas fa-pencil-alt mr-1"></i>
            {{ __('Change Subscription') }}
        </button>
    </div>
</form>
