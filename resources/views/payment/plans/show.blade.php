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
    <script src="{{ asset('js/arrow.js') }}"></script>
    <script src="{{ asset('js/switch.js')}}"></script>
    <script src="{{ asset('js/faq.js')}}"></script>

    <!-- Cookies -->
    <script type="text/javascript" id="cookieinfo"
            src="//cookieinfoscript.com/js/cookieinfo.min.js"
            data-font-family="Open Sans', sans-serif"
            data-bg="#131a26"
            data-fg="#FFFFFF"
            data-link="#CA6D00"
            data-cookie="CookieScript"
            data-text-align="center"
            data-divlink="#FFFFFF"
            data-divlinkbg="#CA6D00"
            data-close-text="Got it!">
    </script>

    <!-- Place your kit's code here -->
    <script src="https://kit.fontawesome.com/f53cf4b771.js" crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,600;0,700;1,400;1,600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/section.css') }}" rel="stylesheet">

    <script src="https://js.stripe.com/v3/"></script>
</head>
<body>
    <div class="container-fluid h-100" style="background-color: rgb(153, 35, 35)">
        <div class="row justify-content-center h-100 align-items-center p-5">
            <div class="col-6">
                <a id="back-button" class="btn btn-primary" href="/" role="button">Back</a>
                <br><br>

                <h3>{{ __($plan->product->name) }} {{ __('plan') }}</h3>
                <h3><strong>{{ __($plan->amount/100) . '€' }} /{{ __($plan->interval) }}</strong></h3>
            </div>
            <div class="col-6">
                <div class="card">
                    <form action="{{ route('subscription.create') }}" method="post" id="payment-form">
                        @csrf
                        @method('post')

                        <div id="card-errors" role="alert">
                            <!-- Used to display form errors. -->
                        </div>

                        <div class="form-group">
                            <div class="card-title pt-3">
                                <h2 class="text-center">{{ __('Billing information') }}</h2>
                            </div>
                            <hr>

                            <div class="card-body pt-0">
                                <div class="form-group mb-2">
                                    <label for="card-holder-name">
                                        {{ __('Name on Card') }}
                                    </label>
                                    <input type="text" class="form-control" id="card-holder-name" placeholder="Joe Mama" required>
                                </div>

                                <div class="form-group mb-2">
                                    <label for="card-holder-email">
                                        {{ __('Email') }}
                                    </label>
                                    <input type="text" class="form-control" id="card-holder-email" placeholder="joe420@inbox.lv" required>
                                </div>

                                <div class="form-group mb-2">
                                    <label for="card-holder-phone">
                                        {{ __('Phone') }}
                                    </label>
                                    <input type="text" class="form-control" id="card-holder-phone" placeholder="+371 22222222" required>
                                </div>
                            </div>

                            <div class="card-title">
                                <h2 class="text-center">{{ __('Payment information') }}</h2>
                            </div>
                            <hr>

                            <div class="card-body pt-0" style="padding-bottom: 5px !important;">
                                <div class="form-group">
                                    <label for="card-element">
                                        {{ __('Credit or debit card') }}
                                    </label>
                                    <div id="card-element" class="form-control">
                                    <!-- A Stripe Element will be inserted here. -->
                                    </div>
                                </div>

                                <input type="hidden" name="plan" value="{{ $plan->id }}" />
                                <input type="hidden" name="role_id" value="{{ $role }}" />

                                <button id="card-button" data-secret="{{ $intent->client_secret }}" class="btn btn-lg btn-dark form-control mt-3" type="submit">
                                    <span id="spinner" class="spinner-border spinner-border-sm hidden" role="status" aria-hidden="true"></span>
                                    <span id="button-text">{{ __("Pay :amount", ['amount' => ($plan->amount/100) . '€']) }}</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<style>
html,body {
  height: 100%;
}
</style>

<script>
    // Disable the button until we have Stripe set up on the page
    document.getElementById('card-button').disabled = true;

    window.addEventListener('load',function()
    {
        // Create a Stripe client.
        var stripe = Stripe('{{ env("STRIPE_KEY") }}');

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
            // Insert the token ID into the form so it gets submitted to the server
            var form = document.getElementById('payment-form');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'paymentMethod');
            hiddenInput.setAttribute('value', paymentMethod);
            form.appendChild(hiddenInput);

            // Submit the form
            form.submit();
        }
    });
</script>
