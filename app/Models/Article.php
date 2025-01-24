<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'image',
        'thumbnail'
    ];

    protected $casts = [
        'views_count' => 'integer',
        'likes_count' => 'integer',
    ];

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function getShortContentAttribute(): string
    {
        return Str::limit($this->content, 100);
    }

    public function getImage(int $width, int $height = null): string
    {
        if ($height) {
            return "https://loremflickr.com/{$width}/{$height}/article,blog/all?lock={$this->image}";
        }
        
        return "https://loremflickr.com/{$width}/{$width}/article,blog/all?lock={$this->image}";
    }
} 