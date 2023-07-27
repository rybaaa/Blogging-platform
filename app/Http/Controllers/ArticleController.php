<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Article::class, options: ['except' => ['index', 'show']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::query()
            ->with(['comments', 'author', 'tags'])
            ->when(
                request('author_id'),
                function ($query, $authorId) {
                    $query->where('author_id', $authorId);
                }
            )
            ->paginate();
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
        $data = $request->validate([
            'content' => ['required', 'string'],
            'title' => ['required', 'string']
        ]);

        $user = auth()->user();

        $data['author_id'] = $user->id;

        $article = new Article($data);
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
        $article = Article::where('id', $id)->with(['author', 'comments', 'tags'])->firstOrFail();
        return response()->json([
            'status' => 200,
            'data' => $article
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
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
    public function destroy(Article $article)
    {
        $article->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Article was deleted',
        ], 200);
    }
}
