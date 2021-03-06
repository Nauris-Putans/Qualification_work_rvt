@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-6">
            <div class="card">
                <form action="{{ route('subscription.create') }}" method="post" id="payment-form">
                    @csrf
                    @method('post')

                    <div class="form-group">
                        <div class="card-header">
                            <label for="card-element">
                                Enter your credit card information
                            </label>
                        </div>
                        <div class="card-body">
                            <div id="card-errors" role="alert">
                                <!-- Used to display form errors. -->
                            </div>

                            <div class="form-group mb-2">
                                <label for="card-holder-name">Name on Card</label>
                                <input type="text" class="form-control" id="card-holder-name" placeholder="Joe Mama">
                            </div>

                            <div class="form-group mb-2">
                                <label for="card-holder-email">Email</label>
                                <input type="text" class="form-control" id="card-holder-email" placeholder="joe420@inbox.lv">
                            </div>

                            <div class="form-group mb-2">
                                <label for="card-holder-phone">Phone</label>
                                <input type="text" class="form-control" id="card-holder-phone" placeholder="+371 22222222">
                            </div>

                            <div class="form-group">
                                <label for="card-element">Credit or debit card</label>
                                <div id="card-element" class="form-control">
                                  <!-- A Stripe Element will be inserted here. -->
                                </div>
                              </div>

                            <input type="hidden" name="plan" value="{{ $plan->id }}" />
                        </div>
                    </div>
                    <div class="card-footer">
                        <button id="card-button" data-secret="{{ $intent->client_secret }}" class="btn btn-dark" type="submit">Pay</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-6">
            <h3>Product name - <strong>{{ $plan->product->name }}</strong> plan</h1>
            <h3>Price - <strong>{{$plan->amount/100}} {{$plan->currency}}<small> /{{$plan->interval}}</small></strong></h3>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
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

        // Handle form submission.
        var form = document.getElementById('payment-form');

        form.addEventListener('submit', function(event)
        {
            event.preventDefault();

            stripe.handleCardSetup(clientSecret, card, {
                payment_method_data: {
                    billing_details: {
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
                    // Inform the user if there was an error.
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                }

                else
                {
                    // Send the token to your server.
                    stripeTokenHandler(result.setupIntent.payment_method);
                }
            });
        });

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
@endsection
