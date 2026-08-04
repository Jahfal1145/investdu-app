<?php

namespace Tests\Feature;

use App\Models\Faq;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FaqPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_faq_page_displays_faqs(): void
    {
        Faq::create([
            'question' => 'Apa itu InvestEdu?',
            'answer' => 'Platform edukasi investasi.',
        ]);

        $response = $this->get('/komunitas/faq');

        $response->assertOk();
        $response->assertSee('Apa itu InvestEdu?');
    }

    public function test_admin_can_open_faq_management_page(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);

        $response = $this->actingAs($admin)->get('/admin/faqs');

        $response->assertOk();
        $response->assertSee('Manajemen FAQ');
    }
}
