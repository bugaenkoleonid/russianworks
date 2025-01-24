<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'article_id' => 'required|exists:articles,id',
            'subject' => 'required|string|max:255',
            'body' => 'required|string'
        ]);

        $comment = Comment::create($validated);

        return response()->json(['message' => 'Comment created successfully'], 201);
    }
} 