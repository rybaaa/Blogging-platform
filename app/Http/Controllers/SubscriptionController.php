<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubscripitonRequest;
use App\Http\Requests\UpdateSubscriptionRequest;
use App\Models\Subscription;
use App\Services\CreditCardValidatorService;
use App\Services\SubscriptionService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    private $subscriptionService;
    private $creditCardValidatorService;

    public function __construct(SubscriptionService $subscriptionService, CreditCardValidatorService $creditCardValidatorService)
    {
        $this->subscriptionService = $subscriptionService;
        $this->creditCardValidatorService = $creditCardValidatorService;
        $this->authorizeResource(Subscription::class, 'subscription');
    }

    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()

    {
        $userSubscriptions =  Subscription::query()->with(['subscriptionPlan'])->where('user_id', Auth::user()->id)->orderBy('end_date')->get();
        return $userSubscriptions;
    }

    /**
     * Store a newly created resource in storage.
     * @param \App\Httt\Requests\StoreSubscripitonRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSubscripitonRequest $request)
    {
        try {
            $newSubscription = $this->subscriptionService->handleSubscription(Auth::user(), $request->validated());
            $newSubscription->save();
        } catch (Exception $error) {
            return response([
                'errors' => [$error->getMessage()]
            ], 422);
        }

        return $newSubscription;
    }

    /**
     * Display the specified resource.
     * 
     * @param \App\Models\Subcsription $subscription
     * @return \Illuminate\Http\Response
     */
    public function show(Subscription $subscription)
    {
        return $subscription->load(['subscriptionPlan', 'user']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSubscriptionRequest  $request
     * @param  \App\Models\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSubscriptionRequest $request, Subscription $subscription)
    {
        $updateData = $request->validated();

        try {
            $this->creditCardValidatorService->validateCreditCard(
                $updateData['credit_card_number'],
                $updateData['expiry_date'],
            );
            if ($updateData['address']) {
                $subscription->update(['address' => $updateData['address']]);
            }
        } catch (Exception $error) {
            return response([
                'errors' => [$error->getMessage()]
            ], 422);
        }

        return response()->json(['message' => 'Payment card updated successfully!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subscription $subscription)
    {
        $subscription->invoice_pay = false;
        $subscription->save();

        return response()->noContent();
    }
}
