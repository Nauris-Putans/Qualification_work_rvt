<?php

namespace App\Http\Controllers;

require_once('../vendor/autoload.php');

use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Laravel\Cashier\Cashier;
use Stripe\Plan;
use \Stripe\Stripe;
use Stripe\Token;
use Laravel\Cashier\Exceptions\IncompletePayment;
use Stripe\Product;

/**
 * SubscriptionController
 */
class SubscriptionController extends Controller
{
    /**
     * retrievePlans
     *
     * @return void
     */
    public function retrievePlans() {
        $key = \config('services.stripe.secret');
        $stripe = new \Stripe\StripeClient($key);
        $plansraw = $stripe->plans->all();
        $plans = $plansraw->data;

        foreach($plans as $plan) {
            $prod = $stripe->products->retrieve(
                $plan->product,[]
            );
            $plan->product = $prod;
        }
        return $plans;
    }

    /**
     * processSubscription
     *
     * @param  mixed $request
     * @return void
     */
    public function processSubscription(Request $request)
    {
        // Retrievs data for mail
        $plan = Plan::retrieve($request->plan);
        $product = Product::retrieve($plan->product);

        // Checks if user is subscribed to selected plan
        if($request->user()->subscribedToPlan($request->plan, 'default'))
        {
            return redirect('/')->with('warning', __('You have already subscribed to this plan!'));
        }

        // Checks if user is already subscribed to any plan
        if ($request->user()->subscribed('default'))
        {
            return redirect('/')->with('info', __('You can change subscription plan in account settings'));

            // TODO jaieliek šis account settings priekš users

            // try
            // {
            //     // Swaps subscription plans
            //     $request->user()
            //         ->subscription('default')->swap($request->plan);
            // }

            // catch (IncompletePayment $exception)
            // {
            //     return redirect()->route(
            //         'cashier.payment',
            //         [$exception->payment->id, 'redirect' => route('home')]
            //     );
            // }
        }

        // Retrvies payment method from form
        $paymentMethod = $request->paymentMethod;

        // Customer options for account info
        $customerOptions = [
            'name' => $request->user()->name,
            'phone' => $request->cardHolderPhone
        ];

        // Creates or gets stripe customer
        $request->user()
            ->createOrGetStripeCustomer($customerOptions);

        // Updates default payment method
        $request->user()
            ->updateDefaultPaymentMethodFromStripe($paymentMethod);

        try
        {
            // Subscribes to new plan with payment method variable $paymentMethod
            $request->user()
                ->newSubscription('default', $request->plan)
                ->withMetadata([
                    'Plan name' => $product->name
                ])
                ->create($paymentMethod, [
                    'email' => $request->user()->email,
                ]);
        }

        catch (IncompletePayment $exception)
        {
            return redirect()->route(
                'cashier.payment',
                [$exception->payment->id, 'redirect' => route('home')]
            );
        }

        // Finds role by request role id
        $role = Role::find($request->role_id);

        // Converts int to string
        $roleID = strval($role->id);

        // Syncs role for current user
        $request->user()->syncRoles([$roleID]);

        // Mail info
        $title = __("Congratulations!");
        $message = __("You are now subscribed to :plan plan", ['plan' => $product->name]);

        $data = [
            'title' => ucfirst($title),
            'message' => $message,
            'product_name' => $product->name,
            'plan_price' => ($plan->amount/100),
        ];

        $to = $request->user()->email;
        $from = ['address' => "info.webcheck@gmail.com", 'name' => __("Subscription Robot")];
        $subject = __("You are now subscribed to :plan plan", ['plan' => $product->name]);

        // Sends mail about subscription
        MailController::sendSubscriptionToEmail($data, $subject, $from, $to);

        return redirect('/')->with('success', __('Successfully subscribed to plan!'));
    }
}
