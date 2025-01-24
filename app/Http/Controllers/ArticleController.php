<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Http\Requests\ArticleRequest;
use Illuminate\Http\JsonResponse;

class ArticleController extends Controller
{
    public function index(): JsonResponse
    {
        $articles = Article::with('tags')->paginate(10);
        return response()->json($articles);
    }

    public function store(ArticleRequest $request): JsonResponse
    {
        $article = Article::create($request->validated());
        
        if ($request->has('tags')) {
            $article->tags()->sync($request->tags);
        }

        return response()->json($article, 201);
    }

    public function show(Article $article): JsonResponse
    {
        $article->load('tags', 'comments');
        $article->increment('views_count');
        return response()->json($article);
    }

    public function like(Article $article): JsonResponse
    {
        $article->increment('likes_count');
        return response()->json(['likes_count' => $article->likes_count]);
    }
} 