<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ImageService
{
    public function saveImage(UploadedFile $image, string $path, int $width = null, int $height = null): string
    {
        $fileName = uniqid() . '.' . $image->getClientOriginalExtension();
        
        if ($width || $height) {
            $img = Image::make($image->getRealPath());
            $img->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            
            Storage::put("public/{$path}/{$fileName}", $img->encode());
        } else {
            Storage::putFileAs("public/{$path}", $image, $fileName);
        }
        
        return "{$path}/{$fileName}";
    }

    public function deleteImage(?string $path): void
    {
        if ($path && Storage::exists("public/{$path}")) {
            Storage::delete("public/{$path}");
        }
    }
} 