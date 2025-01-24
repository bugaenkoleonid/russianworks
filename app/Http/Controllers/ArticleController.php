<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Http\Requests\ArticleRequest;
use App\Services\ImageService;
use Illuminate\Http\JsonResponse;

class ArticleController extends Controller
{
    public function __construct(
        private ImageService $imageService
    ) {}

    public function index(): JsonResponse
    {
        $articles = Article::with('tags')->paginate(10);
        return response()->json($articles);
    }

    public function store(ArticleRequest $request): JsonResponse
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $this->imageService->saveImage(
                $request->file('image'),
                'articles'
            );
        }

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $this->imageService->saveImage(
                $request->file('thumbnail'),
                'thumbnails',
                300,
                200
            );
        }

        $article = Article::create($data);
        
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

    public function destroy(Article $article): JsonResponse
    {
        $this->imageService->deleteImage($article->image);
        $this->imageService->deleteImage($article->thumbnail);
        
        $article->delete();
        
        return response()->json(null, 204);
    }
} 