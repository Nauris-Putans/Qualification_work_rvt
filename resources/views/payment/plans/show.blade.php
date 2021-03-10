<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'WEBcheck') }}</title>

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <!-- Our scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Cookies -->
    <script type="text/javascript" id="cookieinfo"
            src="//cookieinfoscript.com/js/cookieinfo.min.js"
            data-font-family="Open Sans', sans-serif"
            data-bg="#131a26"
            data-fg="#FFFFFF"
            data-link="#CA6D00"
            data-message="{{ __('We use cookies to enhance your experience. By continuing to visit this site you agree to our use of cookies.') }}"
            data-linkmsg="{{ __('More info') }}"
            data-cookie="CookieScript"
            data-text-align="center"
            data-divlink="#FFFFFF"
            data-divlinkbg="#CA6D00"
            data-close-text="{{ __('Got it!') }}">
    </script>

    <!-- Place your kit's code here -->
    <script src="https://kit.fontawesome.com/f53cf4b771.js" crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,600;0,700;1,400;1,600&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/section.css') }}" rel="stylesheet">

    <script src="https://js.stripe.com/v3/"></script>
</head>
<body>
    <div id="app" class="jumbotron vertical-center mb-0" style="background-color: #f8f9fa !important">
        <div class="container">
            <div class="mb-4">
                <a class="icon-block" href="{{ route('pricing') }}">
                    <i class="fas fa-long-arrow-alt-left fa-2x "></i>
                </a>
            </div>

            <div class="row">
                <div class="col-md-4 order-md-2 mb-4">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted">
                            {{ __('Summary') }}
                        </span>
                    </h4>

                    <ul class="list-group mb-3 sticky-top">
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">
                                    {{ __(":plan - plan", ['plan' => __($plan->product->name)]) }}
                                </h6>

                                <small class="text-muted">
                                    {{ __('Brief description') }}
                                </small>
                            </div>

                            <span class="text-muted">
                                <strong>{{ __($plan->amount/100) . '€' }}</strong> /{{ __($plan->interval) }}
                            </span>
                        </li>
                    </ul>
                </div>

                <div class="col-md-8 order-md-1">
                    <h4 class="mb-3">
                        {{ __('Billing information') }}
                    </h4>

                    <form action="{{ route('subscription.create') }}" method="post" id="payment-form">
                        @csrf
                        @method('post')

                        <div class="row" >
                            <div class="col-md-6 mb-3">
                                <label for="card-holder-email">
                                    {{ __('Email') }}*
                                </label>

                                <input type="email" class="form-control" id="card-holder-email" placeholder="jpriede@inbox.lv" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="card-holder-phone">
                                    {{ __('Phone number') }}*
                                </label>

                                <input type="text" class="form-control" id="card-holder-phone" placeholder="+371 22222222" required>
                            </div>
                        </div>

                        <hr class="mb-4">

                        <h4 class="mb-3">
                            {{ __('Payment') }}
                        </h4>

                        <div class="icon-container mb-3">
                            <i class="fab fa-cc-visa fa-2x" style="color:navy;"></i>
                            <i class="fab fa-cc-amex fa-2x" style="color:blue;"></i>
                            <i class="fab fa-cc-mastercard fa-2x" style="color:red;"></i>
                            <i class="fab fa-cc-discover fa-2x" style="color:orange;"></i>
                        </div>

                        <div id="card-errors" class="mb-3" role="alert" style="color: #e3342f;font-weight: 700;">
                            <!-- Used to display form errors. -->
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="card-holder-name">
                                    {{ __('Name on card') }}*
                                </label>

                                <input type="text" class="form-control" id="card-holder-name" placeholder="Janis Priede" required>

                                <small class="text-muted">
                                    {{ __('Full name as displayed on card') }}
                                </small>
                            </div>

                            <div class="col-md-8 mb-3">
                                <label for="card-holder-name">
                                    {{ __('Card information') }}*
                                </label>

                                <div id="card-element" class="form-control">
                                    <!-- A Stripe Element will be inserted here. -->
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="plan" value="{{ $plan->id }}" />
                        <input type="hidden" name="role_id" value="{{ $role }}" />

                        <hr class="mb-4">

                        <button id="card-button" data-secret="{{ $intent->client_secret }}" class="btn btn-primary btn-lg btn-block" type="submit">
                            <span id="spinner" class="spinner-border spinner-border-sm hidden" role="status" aria-hidden="true"></span>
                            <span id="button-text">
                                {{ __("Pay :amount", ['amount' => ($plan->amount/100) . '€']) }}
                            </span>
                        </button>
                    </form>
                </div>
            </div>

            <footer class="my-5 pt-5 text-muted text-center text-small">
                <p class="mb-1">
                    {{ __("© :year. All Rights Reserved.", ['year' => "2021"]) }}
                </p>

                <ul class="list-inline">
                    <li class="list-inline-item">
                        <a href="https://stripe.com/en-lv/privacy">
                            {{ __('Privacy') }}
                        </a>
                    </li>

                    <li class="list-inline-item">
                        <a href="https://stripe.com/en-lv/ssa">
                            {{ __('Terms') }}
                        </a>
                    </li>
                </ul>
            </footer>
        </div>
    </div>
</body>
</html>

<style>
.vertical-center {
  min-height: 100%;
  display: flex;
  align-items: center;
}

.hidden {
    display: none;
}
</style>

<script>
    // Disable the button until we have Stripe set up on the page
    document.getElementById('card-button').disabled = true;

    window.addEventListener('load',function()
    {
        // Finds projects locale language
        var locale = '<?php echo(Config::get('app.locale'));?>';

        // Create a Stripe client.
        var stripe = Stripe('{{ env("STRIPE_KEY") }}', {
            locale: locale
        });

        // Create an instance of Elements.
        var elements = stripe.elements();

        // Custom styling can be passed to options when creating an Element.
        // (Note that this demo uses a wider set of styles than the guide below.)
        var style = {
            base: {
                color: '#32325d',
                lineHeight: '1.429',
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: 'antialiased',
                fontSize: '16px',
                '::placeholder': {
                color: '#aab7c4'
                }
            },
            invalid: {
                color: '#fa755a',
                iconColor: '#fa755a'
            }
        };

        // Create an instance of the card Element.
        var card = elements.create('card', {hidePostalCode: true, style: style});

        // Add an instance of the card Element into the `card-element` <div>.
        card.mount('#card-element');

        const cardHolderName = document.getElementById('card-holder-name');
        const cardHolderEmail = document.getElementById('card-holder-email');
        const cardHolderPhone = document.getElementById('card-holder-phone');
        const cardButton = document.getElementById('card-button');
        const clientSecret = cardButton.dataset.secret;

        // Handle real-time validation errors from the card Element.
        card.addEventListener('change', function(event)
        {
            var displayError = document.getElementById('card-errors');

            if (event.error)
            {
                displayError.textContent = event.error.message;
            }

            else
            {
                displayError.textContent = '';
            }
        });

        // Enable the button when we have Stripe set up on the page
        document.getElementById('card-button').disabled = false;

        // Handle form submission.
        var form = document.getElementById('payment-form');

        form.addEventListener('submit', function(event)
        {
            event.preventDefault();

            changeLoadingState(true);

            // Disable the button until we have Stripe set up on the page
            document.getElementById('card-button').disabled = true;

            stripe.handleCardSetup(clientSecret, card,
            {
                payment_method_data:
                {
                    billing_details:
                    {
                        name: cardHolderName.value,
                        email: cardHolderEmail.value,
                        phone: cardHolderPhone.value
                    }
                }
            })
            .then(function(result)
            {
                if (result.error)
                {
                    changeLoadingState(false);

                    // Disable the button until we have Stripe set up on the page
                    document.getElementById('card-button').disabled = false;

                    // Inform the user if there was an error.
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                }

                else
                {
                    changeLoadingState(false);

                    // Disable the button until we have Stripe set up on the page
                    document.getElementById('card-button').disabled = false;

                    // Send the token to your server.
                    stripeTokenHandler(result.setupIntent.payment_method);
                }
            });
        });

        // Show a spinner on payment submission
        function changeLoadingState(isLoading)
        {
            if (isLoading)
            {
                document.getElementById('card-button').disabled = true;
                document.querySelector("#spinner").classList.remove("hidden");
                document.querySelector("#button-text").classList.add("hidden");
            }

            else
            {
                document.getElementById('card-button').disabled = false;
                document.querySelector("#spinner").classList.add("hidden");
                document.querySelector("#button-text").classList.remove("hidden");
            }
        }

        // Submit the form with the token ID.
        function stripeTokenHandler(paymentMethod)
        {
            changeLoadingState(false);

            // Disable the button until we have Stripe set up on the page
            document.getElementById('card-button').disabled = false;

            // Insert the token ID into the form so it gets submitted to the server
            var form = document.getElementById('payment-form');

            var billingPhone = document.createElement('input');
            billingPhone.setAttribute('type', 'hidden');
            billingPhone.setAttribute('name', 'cardHolderPhone');
            billingPhone.setAttribute('value', cardHolderPhone.value);
            form.appendChild(billingPhone);

            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'paymentMethod');
            hiddenInput.setAttribute('value', paymentMethod);
            form.appendChild(hiddenInput);

            // Submit the form
            form.submit();

            changeLoadingState(false);

            // Disable the button until we have Stripe set up on the page
            document.getElementById('card-button').disabled = false;
        }
    });
</script>
