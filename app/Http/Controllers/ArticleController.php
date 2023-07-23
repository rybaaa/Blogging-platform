<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::query()->with(['comments', 'author', 'tags'])->get();
        return response()->json([
            'status' => 200,
            'data' => $articles
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $article = new Article($request->validate([
            'author_id' => ['required', 'int', 'exists:users,id'],
            'content' => ['required', 'string'],
            'title' => ['required', 'string']
        ]));
        $article->save();
        return response()->json([
            'status' => 201,
            'message' => 'Article was created',
            'data' => $article
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $article = Article::where('id', $id)->with(['author', 'comments.author', 'tags'])->firstOrFail();
        return response()->json([
            'status' => 200,
            'data' => $article
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $article = Article::where('id', $id)->firstOrFail();
        $article->update($request->validate([
            'content' => ['required', 'string'],
            'title' => ['required', 'string']
        ]));
        return response()->json([
            'status' => 200,
            'message' => 'Article was updated',
            'data' => $article
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $article = Article::where('id', $id)->firstOrFail();
        $article->delete();
        return response()->json([
            'status' => 204,
            'message' => 'Article was deleted',
        ], 204);
    }
}
