<?php

namespace App\Jobs;

use App\Models\Article;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class IncrementArticleLikes implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        private readonly int $articleId
    ) {}

    public function handle(): void
    {
        DB::table('articles')
            ->where('id', $this->articleId)
            ->update([
                'likes_count' => DB::raw('likes_count + 1')
            ]);
    }
} 