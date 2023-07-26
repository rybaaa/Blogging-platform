<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTagRequest;
use App\Http\Requests\UpdateTagRequest;
use App\Models\Tag;

class TagController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Tag::class, options: ['except' => ['index', 'show']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = Tag::query()
            ->with(['articles'])
            ->paginate();
        return response()->json([
            'status' => 200,
            'data' => $tags
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTagRequest $request)
    {
        $tag = new Tag($request->validated());
        $tag->author_id = auth()->user()->id;
        $tag->save();

        return response()->json([
            'status' => 201,
            'message' => 'Tag was created',
            'data' => $tag
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        $tag->load(['articles']);
        return response()->json([
            'status' => 200,
            'data' => $tag
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTagRequest $request, Tag $tag)
    {
        $tag->update($request->validated());
        return response()->json([
            'status' => 200,
            'message' => 'Tag was updated',
            'data' => $tag
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Tag was deleted',
        ], 200);
    }
}
