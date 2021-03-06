<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
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
    public function show($planID)
    {
        // Retrieves stripe api
        $stripe = new \Stripe\StripeClient(env("STRIPE_SECRET"));

        // Retrieves current user
        $user = Auth::user();

        // Retrieves plan with $planID variable
        $plan = Plan::retrieve($planID);

        // Retrieves product and adds it to plan
        $prod = Product::retrieve(
            $plan->product,[]
        );

        $plan->product = $prod;

        return view('payment/plans/show', [
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
