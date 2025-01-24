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

    private int $articleId;
    private string $subject;
    private string $body;

    public function __construct(int $articleId, string $subject, string $body)
    {
        $this->articleId = $articleId;
        $this->subject = $subject;
        $this->body = $body;
    }

    public function handle(): void
    {
        sleep(600); // Имитация долгой обработки

        Comment::create([
            'article_id' => $this->articleId,
            'subject' => $this->subject,
            'body' => $this->body,
        ]);
    }
} 