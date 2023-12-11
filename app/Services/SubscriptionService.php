<?php

namespace App\Services;

use App\Models\Subscription;
use App\Models\SubscriptionPlan;
use App\Models\User;
use DateTime;

class SubscriptionService
{
    private $creditCardValidatorService;

    public function __construct(CreditCardValidatorService $creditCardValidatorService)
    {
        $this->creditCardValidatorService = $creditCardValidatorService;
    }

    public function handleSubscription(User $user, ?array $credit_card_info): Subscription
    {

        if (!count($credit_card_info)) {
            $credit_card_info['credit_card_number'] = '4916880588564';
            $credit_card_info['expiry_date'] = '08/25';
            $userWithLastActiveSubscription = User::with(['subscriptions' => function ($query) {
                $query->where('is_active', true)
                    ->orderBy('end_date', 'desc')
                    ->take(1);
            }])->find($user->id);
            $credit_card_info['subscription_plan_id'] = $userWithLastActiveSubscription->subscriptions[0]->subscription_plan_id;
        }

        $this->creditCardValidatorService->validateCreditCard($credit_card_info['credit_card_number'], $credit_card_info['expiry_date']);

        $activeUserSubscription = $user->subscriptions()->where('is_active', 1)->first();

        if ($activeUserSubscription) {
            $activeUserSubscription->deactivateSubscription();
        }
        $startDateTime = new DateTime();
        $start_date = $startDateTime->format('Y-m-d H:i:s');

        $newSubscription = new Subscription(['subscription_plan_id' => $credit_card_info['subscription_plan_id'], 'user_id' => $user->id, 'is_active' => true, 'start_date' => $start_date, 'address' => $credit_card_info['address'] ?? null]);

        $currentSubscriptionExpiryDate = $this->getSubscriptionDate($activeUserSubscription);

        $subscriptionPlan = SubscriptionPlan::query()->where('id', $newSubscription['subscription_plan_id'])->firstOrFail();

        if ($subscriptionPlan->name == 'Monthly') {
            $currentSubscriptionExpiryDate->modify("+1 month");
        } else {
            $currentSubscriptionExpiryDate->modify("+1 year");
        }

        $newSubscription->end_date = $currentSubscriptionExpiryDate->format('Y-m-d H:m:s');
        $user->is_subscriber = true;
        $user->save();
        return $newSubscription;
    }

    private function getSubscriptionDate(?Subscription $subscription): DateTime
    {
        if ($subscription) {
            return new DateTime($subscription->end_date);
        }

        return new DateTime('now');
    }
}
