<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Laratrust\Laratrust;
use Stripe\Plan;
use Stripe\Product;
use Stripe\Service\PlanService;

/**
 * PricingController
 */
class PricingController extends Controller
{
    /**
     * Returns view
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        // Retrieves all plans
        $plans = $this->retrievePlans();

        return view('sections/pricing', compact('plans'));
    }

    /**
     * show
     *
     * @param  mixed $planID
     * @return void
     */
    public function show($planID, Request $request)
    {
        // Retrieves stripe api
        $stripe = new \Stripe\StripeClient(env("STRIPE_SECRET"));

        // Retrieves current user
        $user = Auth::user();

        // Checks if user is auth
        if ($user == null) {
            return redirect('/')->with('info', __('You need to sign in in account to do transactions'));
        }

        // Checks if admin is trying to subscribe to plans
        if (!(Auth::user()->hasRole('userFree')) && !(Auth::user()->hasRole('userPro')) && !(Auth::user()->hasRole('userWebmaster')))
        {
            return redirect('/')->with('warning', __('You are unable to subscribe to plans!'));
        }

        // Retrieves plan with $planID variable
        $plan = Plan::retrieve($planID);

        // Checks if user is subscribed to selected plan
        if($request->user()->subscribedToPlan($plan, 'default'))
        {
            return redirect('/')->with('warning', __('You have already subscribed to this plan!'));
        }

        // Retrieves product and adds it to plan
        $prod = Product::retrieve(
            $plan->product,[]
        );

        $plan->product = $prod;

        return view('payment/plans/show', [
            'role' => $request->role,
            'user' => $user,
            'intent' => $stripe->setupIntents->create([
                'payment_method_types' => ['card'],
            ]),
            'plan' => $plan
        ]);
    }

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
                $plan->product,[]
            );

            $plan->product = $prod;
        }

        return $plans;
    }
}
