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
    public function retrievePlans()
    {
        $stripe = new \Stripe\StripeClient(env("STRIPE_SECRET"));
        $plansraw = $stripe->plans->all();

        $plans = $plansraw->data;
        $plans = array_reverse($plans, true);

        foreach($plans as $plan)
        {
            $prod = $stripe->products->retrieve(
                $plan->product, []
            );

            $plan->product = $prod;
        }

        return $plans;
    }

    /**
     * showPlans
     *
     * @param  mixed $request
     * @return void
     */
    public function showPlans(Request $request)
    {
        $planName = $request->planName;

        // Retrieves all plans
        $plans = $this->retrievePlans();

        return view('payment/plans/change', compact('plans', 'planName'));
    }

    /**
     * showConfirmation
     *
     * @param  mixed $request
     * @return void
     */
    public function showConfirmation(Request $request)
    {
        $planName = $request->planName;

        return view('payment/plans/cancel', compact('planName'));
    }

    // TODO nestrada cancel subscription

    /**
     * cancelSubscription
     *
     * @param  mixed $request
     * @return void
     */
    public function cancelSubscription(Request $request)
    {
        // Creates or gets stripe customer
        $request->user()
            ->createOrGetStripeCustomer();

        try
        {
            // Swaps subscription plans
            $request->user()
                ->subscription('default')
                ->swapAndInvoice(
                    ['price_1IPyAQLPN6FCz2Owwsyt23QS'],
                    ['metadata' => ['Plan name' => 'Free']]
                );
        }

        catch (IncompletePayment $exception)
        {
            return redirect()->route(
                'cashier.payment',
                [$exception->payment->id, 'redirect' => route('home')]
            );
        }

        $request->user()->asStripeCustomer()->subscriptions->data[0]->metadata['Plan name'] = "Free";

        // Finds user free role
        $role = Role::find(1);

        // Converts int to string
        $roleID = strval($role->id);

        // Syncs role for current user
        $request->user()->syncRoles([$roleID]);

        // Mail info
        $title = __("Unfortunately!");
        $message = __("You have canceled subscription to :plan plan", ['plan' => $request->planName]);

        $data = [
            'title' => ucfirst($title),
            'message' => $message,
            'product_name' => $request->planName,
        ];

        $to = $request->user()->email;
        $from = ['address' => "info.webcheck@gmail.com", 'name' => __("Subscription Robot")];
        $subject = __("You have canceled subscription to :plan plan", ['plan' => $request->planName]);

        // Sends mail about subscription
        MailController::sendSubscriptionToEmail($data, $subject, $from, $to);

        return redirect('/user/settings')->with('success', __('Successfully canceled subscription to plan!'));
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
            ->updateDefaultPaymentMethod($paymentMethod);

        // Checks if user is already subscribed to any plan
        if ($request->user()->subscribed('default'))
        {
            $url = '/user/settings';

            try
            {
                // Swaps subscription plans
                $request->user()
                    ->subscription('default')
                    ->swapAndInvoice(
                        [$request->plan],
                        ['metadata' => ['Plan name' => $product->name]]
                    );
            }

            catch (IncompletePayment $exception)
            {
                return redirect()->route(
                    'cashier.payment',
                    [$exception->payment->id, 'redirect' => route('home')]
                );
            }
        }

        else
        {
            $url = '/';

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

        return redirect($url)->with('success', __('Successfully subscribed to plan!'));
    }
}
