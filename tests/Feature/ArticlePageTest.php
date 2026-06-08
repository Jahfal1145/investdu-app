<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ArticlePageTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_blog_page_displays_published_articles(): void
    {
        Article::create([
            'title' => 'Belajar Investasi dari Nol',
            'slug' => 'belajar-investasi-dari-nol',
            'excerpt' => 'Panduan singkat.',
            'content' => 'Isi artikel.',
            'is_published' => true,
            'published_at' => now(),
        ]);

        $response = $this->get('/blog');

        $response->assertOk();
        $response->assertSee('Belajar Investasi dari Nol');
    }

    public function test_admin_can_open_article_management_page(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);

        $response = $this->actingAs($admin)->get('/admin/articles');

        $response->assertOk();
        $response->assertSee('Kelola Blog & Artikel');
    }

    public function test_articles_api_returns_json_payload(): void
    {
        Article::create([
            'title' => 'API Artikel',
            'slug' => 'api-artikel',
            'excerpt' => 'Contoh API.',
            'content' => 'Isi API.',
            'is_published' => true,
            'published_at' => now(),
        ]);

        $response = $this->getJson('/api/articles');

        $response->assertOk();
        $response->assertJsonFragment(['slug' => 'api-artikel']);
    }
}
