<?php

namespace App\Jobs;

use App\Models\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessComment implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        private Comment $comment
    ) {}

    public function handle(): void
    {
        // Здесь логика обработки комментария
        // Например, проверка на спам, нецензурную лексику и т.д.
        
        $this->comment->update(['is_processed' => true]);
    }
} 