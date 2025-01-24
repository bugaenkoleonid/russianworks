<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Http\Requests\ArticleRequest;
use App\Services\ImageService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Jobs\IncrementArticleLikes;
use App\Jobs\IncrementArticleViews;

class ArticleController extends Controller
{
    public function __construct(
        private ImageService $imageService
    ) {}

    public function index(Request $request)
    {
        $query = Article::with('tags')->latest();

        if ($tag = $request->get('tag')) {
            $query->whereHas('tags', function ($q) use ($tag) {
                $q->where('slug', $tag);
            });
        }

        $articles = $query->paginate(10);

        return view('articles.index', compact('articles'));
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

    public function show(Article $article)
    {
        $article->load('tags');
        return view('articles.show', compact('article'));
    }

    public function like(Article $article): JsonResponse
    {
        // Диспетчим задачу в очередь
        IncrementArticleLikes::dispatch($article->id);
        
        // Возвращаем текущее значение + 1, чтобы не ждать обработки очереди
        return response()->json([
            'likes_count' => $article->likes_count + 1
        ]);
    }

    public function view(Article $article): JsonResponse
    {
        // Диспетчим задачу в очередь
        IncrementArticleViews::dispatch($article->id);
        
        // Возвращаем текущее значение + 1, чтобы не ждать обработки очереди
        return response()->json([
            'views_count' => $article->views_count + 1
        ]);
    }

    public function destroy(Article $article): JsonResponse
    {
        $this->imageService->deleteImage($article->image);
        $this->imageService->deleteImage($article->thumbnail);
        
        $article->delete();
        
        return response()->json(null, 204);
    }
} 