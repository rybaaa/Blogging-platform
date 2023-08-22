<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Tag;

class PremiumArticleController extends Controller
{
    public function getPremiumArticles()
    {
        $articles = Article::query()
            ->with(['comments', 'author', 'tags'])
            ->where('premium', true)
            ->when(
                request('author_id'),
                function ($query, $authorId) {
                    $query->where('author_id', $authorId);
                }
            )
            ->when(
                request('tag'),
                function ($query, $tag) {
                    $query->whereHas('tags', function ($subQuery) use ($tag) {
                        $subQuery->where('title', $tag);
                    });
                }
            )
            ->orderBy('created_at', 'desc')
            ->paginate();
        return response()->json([
            'status' => 200,
            'data' => $articles
        ]);
    }
}
