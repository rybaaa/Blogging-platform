<?php

namespace Database\Factories;

use App\Models\SubscriptionPlan;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subscription>
 */
class SubscriptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $subscriptionPlanId = $this->faker->randomElement([1, 2]);

        if ($subscriptionPlanId === 1) {
            $startDate = $this->faker->dateTimeBetween('-1 month', 'now');
            $endDate = Carbon::instance($startDate)->addMonth();
        } else {
            $startDate = $this->faker->dateTimeBetween('-1 year', 'now');
            $endDate = Carbon::instance($startDate)->addYear();
        }

        return [
            'user_id' => User::factory(),
            'subscription_plan_id' => $subscriptionPlanId,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'is_active' => true,
            'invoice_pay' => true,
            'address' => $this->faker->address,
        ];
    }
}
