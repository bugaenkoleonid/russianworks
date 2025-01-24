<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'article_id' => 'required|exists:articles,id',
            'subject' => 'required|string|max:255',
            'body' => 'required|string'
        ];
    }
} 