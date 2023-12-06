<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $data = $request->validate([
            'content' => ['required', 'string'],
            'title' => ['required', 'string'],
            'premium' => ['required', 'boolean'],
        ]);

        $user = auth()->user();

        $data['author_id'] = $user->id;
        $article = new Article($data);
        $article->save();

        if ($tagContent = request()->input('tags')) {
            $this->attachTags($article, $tagContent);
        }

        if ($coverPhotoBase64 = request()->input('cover_photo')) {
            $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $coverPhotoBase64));

            $fileName = 'cover_' . time() . '.png';

            Storage::put('public/covers/' . $fileName, $imageData);

            $article->cover_url = Storage::url('public/covers/' . $fileName);
            $article->save();
        }



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
        $user = Auth::guard('sanctum')->user() ?? null;

        if ($article->premium && (is_null($user) || (!is_null($user) && !$user->is_subscriber))) {
            $sentences = preg_split('/(?<=[.!?])\s+/', $article->content, -1, PREG_SPLIT_NO_EMPTY);
            $firstTwoSentences = array_slice($sentences, 0, 2);
            $article->content = implode(' ', $firstTwoSentences);
        }


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

        $data = $request->validate([
            'content' => ['required', 'string'],
            'title' => ['required', 'string'],
            'premium' => ['required', 'boolean'],
        ]);

        $article->update($data);

        if ($tagContent = request()->input('tags')) {
            $this->deleteOldTags($article);
            $this->attachTags($article, $tagContent);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Article was updated',
            'data' => $article
        ], 200);
    }
    protected function deleteOldTags(Article $article)
    {
        $article->tags()->detach();
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

    private function attachTags(Article $article, array $tagContent)
    {
        // create the tags if they don't exist already
        /*[
            ['title' => 'foobar'],
            ['title' => 'another tag'],
          ]*/

        $tagUpsertData = collect($tagContent)->map(fn ($content) => ['title' => $content])->all();
        foreach ($tagUpsertData as &$tagData) {
            $tagData['author_id'] = auth()->user()->id;
        }
        Tag::upsert($tagUpsertData, ['title']);

        // fetch the tags so that they may be attached
        $tags = Tag::query()->whereIn('title', $tagContent)->get('id');
        $article->tags()->attach($tags);
    }
}
