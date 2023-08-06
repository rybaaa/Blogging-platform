<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(User::class, options: ['except' => ['index', 'show', 'store']]);
    }

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
        return $this->store($request);
    }

    public function me(Request $request)
    {
        return $request->user();
    }

    public function index()
    {
        return User::paginate();
    }

    public function show(User $user)
    {
        return $user;
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', Password::min(8)],
            'name' => ['required', 'string'],
        ]);

        $user = User::query()->firstWhere('email', $credentials['email']);
        if (!is_null($user)) {
            throw ValidationException::withMessages(['User with this email already exists']);
        }

        $user = new User($credentials);
        $user->save();

        if ($avatar = request()->file('avatar')) {
            $request->validate(['avatar' => 'image']);
            $filePath = $avatar->storePublicly('public/avatars');
            $user->avatar = Storage::url($filePath);
            $user->save();
        }

        $token = $user->createToken('user token')->plainTextToken;

        return response()->json([
            'status' => 200,
            'message' => 'User has been created',
            'token' => $token,
            'data' => $user
        ]);
    }

    public function update(User $user, Request $request)
    {
        $user->update($request->validate([
            'name' => ['required', 'string'],
            'email' => ['email'],
        ]));

        if ($avatar = request()->file('avatar')) {
            $request->validate(['avatar' => 'image']);
            if ($user->avatar) {
                $oldAvatarPath = str_replace(
                    'storage',
                    'public',
                    str_replace("http://localhost/", "", $user->avatar)
                );
                Storage::delete($oldAvatarPath);
            }
            $filePath = $avatar->storePublicly('public/avatars');
            $user->avatar = Storage::url($filePath);
            $user->save();
        }

        return response()->json([
            'status' => 200,
            'message' => 'User profile has been updated',
            'data' => $user
        ]);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return response()->json([
            'status' => 200,
            'message' => 'User has been deleted'
        ]);
    }

    public function logout()
    {
        $user = request()->user();

        $user->tokens()->delete();

        return response()->json([
            'status' => 200,
            'message' => 'You are logged out'
        ]);
    }
}
