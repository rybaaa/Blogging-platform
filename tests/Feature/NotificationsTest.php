<?php

namespace Tests\Feature;

use App\Models\User;
use App\Services\Notifications\ModeratorNotifier;
use App\Services\Notifications\NotificationChannel;
use App\Services\Notifications\TwitterNotifier;
use App\Services\Notifications\UserNotifier;
use Mockery;
use Mockery\MockInterface;
use Tests\TestCase;

class NotificationsTest extends TestCase
{
    public function test_example(): void
    {
        /** @var MockInterface */

        $mocks = [
            Mockery::mock(TwitterNotifier::class),
            Mockery::mock(UserNotifier::class),
            Mockery::mock(ModeratorNotifier::class),
        ];

        foreach ($mocks as $mock) {
            $mock
                ->shouldReceive('notifyAbout')
                ->once()
                ->andReturn(true);
        }

        $this->app->instance(NotificationChannel::class, $mocks);

        $user = User::factory()->createOne();

        $this->actingAs($user)->postJson(
            route('articles.store'),
            [
                'content' => 'whatever',
                'title' => 'foobar',
            ]
        );
    }
}
