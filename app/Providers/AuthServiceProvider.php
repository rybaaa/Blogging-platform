<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Auth::viaRequest('custom-token', function (Request $request): ?User {
            $bearerToken = $request->bearerToken();
            if (is_null($bearerToken)) {
                return null;
            }

            $token = explode(' ', $bearerToken)[1] ?? null;
            if (is_null($token)) {
                return null;
            }
            $token = Str::of(base64_decode($token));
            [$secret, $userId] = $token->explode('-');

            $user = User::query()->firstWhere('id', $userId);

            return $user;
        });
    }
}
