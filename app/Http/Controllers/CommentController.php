<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Comment;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comments = Comment::query()->with(['author'])->get();
        return response()->json([
            'status' => 200,
            'data' => $comments
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommentRequest $request)
    {
        $comment = new Comment($request->validated());
        $comment->save();
        return response()->json([
            'status' => 201,
            'message' => 'Comment was created',
            'data' => $comment
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        $comment->load(['article', 'author']);
        return response()->json([
            'status' => 200,
            'data' => $comment
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        $comment->update($request->validated());
        return response()->json([
            'status' => 200,
            'message' => 'Comment was updated',
            'data' => $comment
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return response()->json([
            'status' => 204,
            'message' => 'Comment was deleted',
        ], 204);
    }
}
