<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\TagController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rules\Password;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

$guestRoutes = ['index', 'show'];

Route::apiResource('/articles', ArticleController::class)
    ->middleware('auth:sanctum')
    ->except($guestRoutes);

Route::apiResource('/articles', ArticleController::class)
    ->only($guestRoutes);

Route::apiResource('/comments', CommentController::class)
    ->middleware('auth:sanctum')
    ->except($guestRoutes);

Route::apiResource('/comments', CommentController::class)
    ->only($guestRoutes);

Route::apiResource('/tags', TagController::class)
    ->middleware('auth:sanctum')
    ->except($guestRoutes);

Route::apiResource('/tags', TagController::class)
    ->only($guestRoutes);


Route::post('/auth', function (Request $request) {
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
});
