<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Jobs\ProcessComment;
use Illuminate\Http\JsonResponse;

class CommentController extends Controller
{
    public function store(StoreCommentRequest $request): JsonResponse
    {
        ProcessComment::dispatch(
            $request->article_id,
            $request->subject,
            $request->body
        );

        return response()->json(['message' => 'Комментарий поставлен в очередь на обработку']);
    }
} 