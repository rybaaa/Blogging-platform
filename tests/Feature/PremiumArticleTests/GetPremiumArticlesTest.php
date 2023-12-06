<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Article;

class GetPremiumArticlesTest extends TestCase
{
    public function test_get_all_articles(): void
    {
        // First we are creating 5 premium articles

        Article::factory()
        ->count(5)
        ->state([
            'premium' => true,
        ])
        ->create();

        // Here we are creating 5 non-premium articles

        Article::factory()
        ->count(5)
        ->state([
            'premium' => false,
        ])
        ->create();

        $response = $this->get(route('articles.index'));

        // Here we are checking if the numbers of created articles is equal to the number of stored articles

        $totalNumberOfArticles = $response->json('data.total');
        $this->assertEquals(10, $totalNumberOfArticles);
    }


    public function test_get_all_premium_articles(): void
    {
        // First we are creating 50 premium articles

        Article::factory()
        ->count(50)
        ->state([
            'premium' => true,
        ])
        ->create();

        // Then we are creating 80 non-premium articles

        Article::factory()
        ->count(80)
        ->state([
            'premium' => false,
        ])
        ->create();

        $response = $this->get(route('articles.index'));
        $totalArticles = $response->json('data.total');
        $lastPage = $response->json('data.last_page');
    
        $premiumArticleCount = 0;

        // And here we are checking if the numbers of created premium articles is equal to the number of stored premium articles
    
        for ($page = 1; $page <= $lastPage; $page++) {
            $response = $this->get(route('articles.index', ['page' => $page]));
            $responseData = $response->json('data.data');

            foreach ($responseData as $article) {
                if ($article['premium']) {
                    $premiumArticleCount++;
                }
            }
        }
        
        $response->assertStatus(200);
        $this->assertEquals(50, $premiumArticleCount);
    }


    public function test_get_all_non_premium_articles(): void
    {
        // First we are creating 50 premium articles

        Article::factory()
        ->count(50)
        ->state([
            'premium' => true,
        ])
        ->create();

        // Then we are creating 80 non-premium articles

        Article::factory()
        ->count(80)
        ->state([
            'premium' => false,
        ])
        ->create();

        $response = $this->get(route('articles.index'));
        $totalArticles = $response->json('data.total');
        $lastPage = $response->json('data.last_page');
    
        $premiumArticleCount = 0;

        // And here we are checking if the numbers of created non-premium articles is equal to the number of stored non-premium articles
    
        for ($page = 1; $page <= $lastPage; $page++) {
            $response = $this->get(route('articles.index', ['page' => $page]));
            $responseData = $response->json('data.data');

            foreach ($responseData as $article) {
                if (!$article['premium']) {
                    $premiumArticleCount++;
                }
            }
        }
        
        $response->assertStatus(200);
        $this->assertEquals(80, $premiumArticleCount);
    }

}
