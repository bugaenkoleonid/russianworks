<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Http\Requests\CommentRequest;
use Illuminate\Http\JsonResponse;

class CommentController extends Controller
{
    public function store(CommentRequest $request): JsonResponse
    {
        $comment = Comment::create($request->validated());
        return response()->json($comment, 201);
    }
} 