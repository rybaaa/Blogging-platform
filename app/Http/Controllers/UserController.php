<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function auth(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', Password::min(8)]
        ]);

        $user = User::query()->firstWhere('email', $credentials['email']);
        if (!Auth::attempt($credentials)) {
            return response()->json(['status' => 403, 'message' => 'invalid credentials'], 403);
        }

        $token = $user->createToken('user token')->plainTextToken;

        return ['token' => $token];
    }

    public function register(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', Password::min(8)],
            'name' => ['required', 'string']
        ]);

        $user = User::query()->firstWhere('email', $credentials['email']);
        if (!is_null($user)) {
            throw ValidationException::withMessages(['User with this email already exists']);
        }

        $user = new User($credentials);
        $user->save();

        $token = $user->createToken('user token')->plainTextToken;

        return ['token' => $token];
    }

    public function me(Request $request)
    {
        return $request->user();
    }
}
