<?php

namespace Tests\Feature;

use App\Enums\NewsCategory;
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

    public function test_home_shows_looker_embed_and_latest_news(): void
    {
        NewsUpdate::factory()->create(['title' => 'Berita Lama', 'published_at' => now()->subDays(3)]);
        NewsUpdate::factory()->create(['title' => 'Berita Baru', 'published_at' => now()->subHour()]);
        LookerStudio::factory()->create(['url' => 'https://lookerstudio.google.com/embed/reporting/abc/page/1']);

        $this->get('/')
            ->assertOk()
            ->assertSeeInOrder(['Berita Baru', 'Berita Lama'])
            ->assertSee('https://lookerstudio.google.com/embed/reporting/abc/page/1', false);
    }

    public function test_featured_news_comes_first_on_home(): void
    {
        NewsUpdate::factory()->create(['title' => 'Biasa Terbaru', 'published_at' => now()->subHour()]);
        NewsUpdate::factory()->create(['title' => 'Sorotan Lama', 'is_featured' => true, 'published_at' => now()->subDays(5)]);

        $this->get('/')->assertSeeInOrder(['Sorotan Lama', 'Biasa Terbaru']);
    }

    public function test_drafts_and_scheduled_news_are_hidden(): void
    {
        $draft = NewsUpdate::factory()->draft()->create(['title' => 'Masih Draf']);
        $scheduled = NewsUpdate::factory()->scheduled()->create(['title' => 'Belum Waktunya']);

        $this->get('/')->assertDontSee('Masih Draf')->assertDontSee('Belum Waktunya');
        $this->get('/kabar')->assertDontSee('Masih Draf')->assertDontSee('Belum Waktunya');
        $this->get('/kabar/'.$draft->slug)->assertNotFound();
        $this->get('/kabar/'.$scheduled->slug)->assertNotFound();
    }

    public function test_news_detail_renders_markdown_and_source(): void
    {
        $news = NewsUpdate::factory()->create([
            'title' => 'Cegah Demam Berdarah',
            'content' => "Lakukan **3M Plus** setiap minggu.\n\n[Info](https://example.go.id)",
            'source_name' => 'Kemenkes',
            'source_url' => 'https://example.go.id/dbd',
        ]);

        $this->get('/kabar/'.$news->slug)
            ->assertOk()
            ->assertSee('<strong>3M Plus</strong>', false)
            ->assertSee('Kemenkes')
            ->assertSee('https://example.go.id/dbd', false)
            ->assertSee('bukan pengganti konsultasi');
    }

    public function test_news_content_is_sanitised(): void
    {
        $news = NewsUpdate::factory()->create([
            'content' => "<script>alert(1)</script>\n\n[klik](javascript:alert(1))",
            'source_url' => 'javascript:alert(1)',
            'source_name' => null,
        ]);

        $this->get('/kabar/'.$news->slug)
            ->assertOk()
            ->assertDontSee('<script>alert(1)</script>', false)
            ->assertDontSee('href="javascript:', false);
    }

    public function test_news_index_filters_by_category(): void
    {
        NewsUpdate::factory()->create(['title' => 'Soal Edukasi', 'category' => NewsCategory::Education]);
        NewsUpdate::factory()->create(['title' => 'Soal Kegiatan', 'category' => NewsCategory::Activity]);

        $this->get('/kabar?kategori=education')->assertSee('Soal Edukasi')->assertDontSee('Soal Kegiatan');
        $this->get('/kabar?kategori=tidak-ada')->assertSee('Soal Edukasi')->assertSee('Soal Kegiatan');
    }

    public function test_slug_is_generated_and_unique(): void
    {
        $first = NewsUpdate::factory()->create(['title' => 'Judul Sama', 'slug' => null]);
        $second = NewsUpdate::factory()->create(['title' => 'Judul Sama', 'slug' => null]);

        $this->assertSame('judul-sama', $first->slug);
        $this->assertSame('judul-sama-2', $second->slug);
    }

    public function test_disease_pages_list_configured_diseases_with_medical_disclaimer(): void
    {
        $response = $this->get('/service')->assertOk()->assertSee('bukan pengganti konsultasi', false);

        foreach (config('diseases') as $disease) {
            $response->assertSee($disease['name'])->assertSee('id="'.$disease['slug'].'"', false);
            $this->get('/')->assertSee('/service#'.$disease['slug'], false);
        }
    }

    public function test_layout_has_landmarks_and_no_admin_button_in_navigation(): void
    {
        $html = $this->get('/')
            ->assertSee('lang="id"', false)
            ->assertSee('href="#main"', false)
            ->assertSee('<main id="main">', false)
            ->getContent();

        $this->assertStringNotContainsString('Masuk Admin', $html);
        $this->assertStringContainsString('Masuk pengelola', $html);
    }
}
