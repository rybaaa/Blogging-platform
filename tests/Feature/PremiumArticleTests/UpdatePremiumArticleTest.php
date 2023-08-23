<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Article;

class UpdatePremiumArticleTest extends TestCase
{
    public function test_update_premium_article_to_false(): void
    {
        // First we are creating the author
        $author = User::factory()
            ->set('password', '12345678')
            ->set('email', 'test@test.com')
            ->createOne();
        
        // Then we are creating the article as the author and setting the value of premium to true
        $article = Article::factory()
        ->set('author_id', $author->id)
        ->set('premium', true)
        ->createOne();

        // Updating the article as an author and setting the value of premium to false
        $response = $this
            ->actingAs($author)
            ->patchJson(
                route('articles.update', [$article->id]),
                [
                    'content' => 'Updated content',
                    'title' => 'Updated title',
                    'premium' => false
                ]
            );

        $response->assertStatus(200);
        
        $article->refresh();

        // Checking if the value of premium has been updated to false and if the other fields have been updated
        $this->assertEquals('Updated content', $article->content);
        $this->assertEquals('Updated title', $article->title);
        $this->assertFalse($article->premium);
    }


    public function test_update_premium_article_to_true(): void
    {
        // First we are creating the author
        $author = User::factory()
            ->set('password', '12345678')
            ->set('email', 'test@test.com')
            ->createOne();

        // Then we are creating the article as the author and setting the value of premium to false
        $article = Article::factory()
        ->set('author_id', $author->id)
        ->set('premium', false)
        ->createOne();

        // Updating the article as an author and setting the value of premium to true
        $response = $this
            ->actingAs($author)
            ->patchJson(
                route('articles.update', [$article->id]),
                [
                    'content' => 'Updated content',
                    'title' => 'Updated title',
                    'premium' => true
                ]
            );

        $response->assertStatus(200);
        
        $article->refresh();

        // Checking if the value of premium has been updated to true and if the other fields have been updated
        $this->assertEquals('Updated content', $article->content);
        $this->assertEquals('Updated title', $article->title);
        $this->assertTrue($article->premium);
    }
}
