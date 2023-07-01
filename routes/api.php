<?php

use App\Models\Article;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/hello-world', function (Request $request) {
    return ['hello' => 'world'];
});
Route::get('/articles', function (Request $request) {
    return Article::all();
});
Route::get('/articles/{id}', function ($id) {
    return Article::find($id);

});
Route::post('/articles', function (Request $request) {
    $article = new Article($request->toArray());
    $article->save();
    return response($request->toArray(), 200);
});

Route::patch('/articles/{id}', function (Request $request, $id) {
    $article = Article::find($id);
    $article->title = $request->input('title');
    $article->content = $request->input('content');
    $article->timestamps = false;
    $article->save();
    return response("Article is updated");
});
Route::delete('/articles/{id}', function ($id) {
    $article = Article::find($id);
    $article->delete();
    return response('Article is deleted');
});