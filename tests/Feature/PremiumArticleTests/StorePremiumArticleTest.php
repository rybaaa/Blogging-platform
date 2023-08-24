<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Article;

class StorePremiumArticleTest extends TestCase
{
    public function test_store_article_with_premium_set_to_true(): void
    {
        // First we are creating the author
        $author = User::factory()
            ->set('password', '12345678')
            ->set('email', 'test@test.com')
            ->createOne();
        
        // Then we are creating the article as the author and setting  the premium to true
        $response = $this
            ->actingAs($author)
            ->postJson(
                route('articles.store'),
                [
                    'content' => 'testing article',
                    'title' => 'test title',
                    'premium' => true
                ]
            );

        $response->assertStatus(201);
        $articles = Article::all();
        $this->assertCount(1, $articles);

        // Checking if the premium field is present and is set to true
        $storedArticle = $articles->first();
        $this->assertTrue($storedArticle->premium);
    }


    public function test_store_article_with_premium_set_to_false(): void
    {
        // First we are creating the author
        $author = User::factory()
            ->set('password', '12345678')
            ->set('email', 'test@test.com')
            ->createOne();
        
        // Then we are creating the article as the author and setting the premium to false
        $response = $this
            ->actingAs($author)
            ->postJson(
                route('articles.store'),
                [
                    'content' => 'testing article',
                    'title' => 'test title',
                    'premium' => false
                ]
            );

        $response->assertStatus(201);
        $articles = Article::all();
        $this->assertCount(1, $articles);

        // Checking if the premium field is present and is set to false
        $storedArticle = $articles->first();
        $this->assertFalse($storedArticle->premium);
    }
    

}
