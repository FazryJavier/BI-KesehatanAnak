<?php

namespace Tests\Feature;

use App\Models\LookerStudio;
use App\Models\NewsUpdate;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicPagesTest extends TestCase
{
    use RefreshDatabase;

    public function test_pages_render_when_no_content_exists(): void
    {
        foreach (['/', '/kabar', '/service', '/looker'] as $path) {
            $this->get($path)->assertOk();
        }
    }

    public function test_home_shows_latest_news_and_looker_embed(): void
    {
        NewsUpdate::factory()->create(['content' => 'Old news']);
        NewsUpdate::factory()->create(['content' => 'Newest news']);
        LookerStudio::factory()->create(['url' => 'https://lookerstudio.google.com/embed/reporting/abc/page/1']);

        $this->get('/')
            ->assertOk()
            ->assertSee('Newest news')
            ->assertDontSee('Old news')
            ->assertSee('https://lookerstudio.google.com/embed/reporting/abc/page/1', false);
    }

    public function test_disease_pages_list_configured_diseases_with_medical_disclaimer(): void
    {
        $response = $this->get('/service')->assertOk()->assertSee('bukan pengganti konsultasi', false);

        foreach (config('diseases') as $disease) {
            $response->assertSee($disease['name'])->assertSee('id="'.$disease['slug'].'"', false);
            $this->get('/')->assertSee('/service#'.$disease['slug'], false);
        }
    }

    public function test_layout_has_accessibility_landmarks(): void
    {
        $this->get('/')
            ->assertSee('lang="id"', false)
            ->assertSee('href="#main"', false)
            ->assertSee('<main id="main">', false);
    }

    public function test_news_content_is_escaped(): void
    {
        NewsUpdate::factory()->create(['content' => '<script>alert(1)</script>']);

        $this->get('/kabar')->assertOk()->assertDontSee('<script>alert(1)</script>', false);
    }
}
