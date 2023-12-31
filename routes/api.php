<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\PremiumArticleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\SubscriptionPlanController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;

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


$guestRoutes = ['index', 'show'];

Route::post('/auth', [UserController::class, 'auth']);
Route::post('/register', [UserController::class, 'register']);
Route::get('/me', [UserController::class, 'me'])->middleware('auth:sanctum');
Route::get('/logout', [UserController::class, 'logout'])->middleware('auth:sanctum');
Route::post('/upload-avatar', [UserController::class, 'uploadAvatar'])->middleware('auth:sanctum');
Route::get('/subscription-plans', [SubscriptionPlanController::class, 'index']);
Route::get('/premium-articles', [PremiumArticleController::class, 'getPremiumArticles'])->middleware('auth:sanctum');

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

Route::apiResource('/users', UserController::class)
    ->middleware('auth:sanctum')
    ->except(array_merge($guestRoutes, ['store']));

Route::apiResource('/users', UserController::class)
    ->only(array_merge($guestRoutes, ['store']));

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('/subscriptions', SubscriptionController::class);
    Route::get('/subscriptions/{subscription}/download-invoice', [SubscriptionController::class, 'downloadInvoice']);
});
