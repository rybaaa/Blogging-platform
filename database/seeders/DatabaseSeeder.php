<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Article;
use App\Models\Comment;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Article::factory(10)->create();
        $this->call(TagSeeder::class);
        $this->call(CommentSeeder::class);
        foreach (Article::all() as $article) {
            $randomTagCount = rand(1, 5);
            $tags = Tag::inRandomOrder()->take($randomTagCount)->get();
            $article->tags()->attach($tags->pluck('id'));
        }
        User::factory()
            ->set('email', 'test@test.com')
            ->set('password', bcrypt('12345678'))
            ->create();
        $this->call(SubscriptionPlanSeeder::class);
    }
}
