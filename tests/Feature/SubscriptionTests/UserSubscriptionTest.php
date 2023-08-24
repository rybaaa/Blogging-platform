<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\PremiumArticlesTestCase;
use App\Models\User;
use App\Models\Subscription;

class UserSubscriptionTest extends PremiumArticlesTestCase
{

    public function test_user_can_make_a_subscription(): void
    {
        $user = User::factory()->createOne();

        $response = $this
            ->actingAs($user)
            ->postJson(
                '/api/subscriptions',
                [
                    'name' => 'New',
                    'surname' => 'New',
                    'subscription_plan_id' => '1',
                    'credit_card_number' => '4242424242424242',
                    'ccv' => '845',
                    'expiry_date' => '12/25',
                    'address' => '',
                ]
            );
        $isSubscriber = $user->is_subscriber;

        $this->assertTrue($isSubscriber);
        $response->assertStatus(201);
        
    }

    public function test_user_can_update_their_subscription(): void
    {
        $subscription = Subscription::factory()->createOne();

        $user = User::findOrFail($subscription->user_id);

        $response = $this->actingAs($user)->patchJson(
            "/api/subscriptions/{$subscription->id}",
            [
                'credit_card_number' => '4242424242424242',
                'ccv' => '321',
                'expiry_date' => '12/30',
                'address' => 'New Address',
                'name' => 'Test Name',
                'surname' => 'Test Surname'
            ]
        );

        $response->assertStatus(200);
        $response->assertSee('Payment card updated successfully!');
    }


    public function test_user_can_delete_their_subscription(): void
    {
        $subscription = Subscription::factory()->createOne(['invoice_pay' => true]);

        $this->assertTrue($subscription->invoice_pay);

        $user = User::findOrFail($subscription->user_id);

        $response = $this
        ->actingAs($user)
        ->deleteJson(
            "/api/subscriptions/{$subscription->id}"
        );

        $subscription->refresh();

        $this->assertFalse($subscription->invoice_pay);
        $response->assertStatus(204);

    }



}
