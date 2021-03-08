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
        // Checks if user is subscribed to selected plan
        if($request->user()->subscribedToPlan($request->plan, 'default'))
        {
            return redirect('/')->with('warning', __('You have already subscribed to this plan!'));
        }

        // Retrvies payment method from form
        $paymentMethod = $request->paymentMethod;

        // Creates or gets stripe customer
        $request->user()
            ->createOrGetStripeCustomer();

        // Updates default payment method
        $request->user()
            ->updateDefaultPaymentMethod($paymentMethod);

        // Subscribes to new plan with payment method variable $paymentMethod
        $request->user()
            ->newSubscription('default', $request->plan)
            ->create($paymentMethod, [
                'email' => $request->user()->email,
            ]);

        // Finds role by request role id
        $role = Role::find($request->role_id);

        // Converts int to string
        $roleID = strval($role->id);

        // Syncs role for current user
        $request->user()->syncRoles([$roleID]);

        return redirect('/')->with('success', __('Successfully subscribed to plan!'));
    }
}
