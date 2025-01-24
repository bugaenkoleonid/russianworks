<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TagSeeder extends Seeder
{
    public function run(): void
    {
        $faker = \Faker\Factory::create('en_US');
        
        for ($i = 0; $i < 10; $i++) {
            Tag::create([
                'name' => $faker->word(),
            ]);
        }

        $tags = collect(['PHP', 'Laravel', 'Vue.js', 'JavaScript', 'CSS', 'HTML', 'Git', 'Docker'])
            ->map(function ($tag) {
                return Tag::create([
                    'name' => $tag,
                    'slug' => Str::slug($tag),
                ]);
            });

        Article::all()->each(function ($article) use ($tags) {
            $article->tags()->attach(
                $tags->random(rand(1, 3))->pluck('id')->toArray()
            );
        });
    }
} 