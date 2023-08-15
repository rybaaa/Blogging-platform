<?php

namespace App\Providers;

use App\Services\Notifications\ModeratorNotifier;
use App\Services\Notifications\NotificationChannel;
use App\Services\Notifications\TwitterNotifier;
use App\Services\Notifications\UserNotifier;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(NotificationChannel::class, function () {
            return [
                new TwitterNotifier,
                new ModeratorNotifier,
                new UserNotifier,
            ];
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::shouldBeStrict(true);
    }
}
