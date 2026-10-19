<?php

namespace Tests\Feature\Admin;

use App\Enums\NewsCategory;
use App\Enums\NewsStatus;
use App\Filament\Pages\Login;
use App\Filament\Resources\LookerStudios\Pages\CreateLookerStudio;
use App\Filament\Resources\NewsUpdates\Pages\CreateNewsUpdate;
use App\Filament\Resources\NewsUpdates\Pages\ListNewsUpdates;
use App\Filament\Resources\Users\Pages\CreateUser;
use App\Filament\Resources\Users\Pages\EditUser;
use App\Models\LookerStudio;
use App\Models\NewsUpdate;
use App\Models\User;
use Database\Seeders\RoleSeeder;
use Filament\Actions\Testing\TestAction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Livewire\Livewire;
use Spatie\Permission\Models\Role;
use Tests\Concerns\CreatesAdmins;
use Tests\TestCase;

class AdminPanelTest extends TestCase
{
    use CreatesAdmins;
    use RefreshDatabase;

    private const PANEL_PATHS = ['/admin', '/admin/news-updates', '/admin/looker-studios', '/admin/users', '/admin/shield/roles'];

    public function test_guests_are_redirected_to_login(): void
    {
        foreach (self::PANEL_PATHS as $path) {
            $this->get($path)->assertRedirect('/admin/login');
        }
    }

    public function test_login_page_renders(): void
    {
        $this->get('/admin/login')->assertOk();
    }

    public function test_admin_can_log_in_with_username(): void
    {
        $user = $this->createAdmin(attributes: ['username' => 'jane', 'password' => 'secret-pass']);

        Livewire::test(Login::class)
            ->fillForm(['username' => 'jane', 'password' => 'secret-pass'])
            ->call('authenticate')
            ->assertHasNoFormErrors();

        $this->assertAuthenticatedAs($user);
    }

    public function test_login_fails_with_wrong_password(): void
    {
        $this->createAdmin(attributes: ['username' => 'jane', 'password' => 'secret-pass']);

        Livewire::test(Login::class)
            ->fillForm(['username' => 'jane', 'password' => 'wrong'])
            ->call('authenticate')
            ->assertHasFormErrors(['username']);

        $this->assertGuest();
    }

    public function test_account_without_role_cannot_enter_panel(): void
    {
        $this->seed(RoleSeeder::class);
        User::factory()->create(['username' => 'norole', 'password' => 'secret-pass']);

        Livewire::test(Login::class)
            ->fillForm(['username' => 'norole', 'password' => 'secret-pass'])
            ->call('authenticate');

        $this->assertGuest();

        $this->actingAs(User::where('username', 'norole')->firstOrFail())
            ->get('/admin')
            ->assertForbidden();
    }

    public function test_super_admin_sees_every_resource_page(): void
    {
        $this->actingAs($this->createAdmin());

        foreach (self::PANEL_PATHS as $path) {
            $this->get($path)->assertOk();
        }
    }

    public function test_editor_manages_news_but_not_users_or_roles(): void
    {
        $this->actingAs($this->createAdmin(RoleSeeder::EDITOR));

        $this->get('/admin/news-updates')->assertOk();
        $this->get('/admin/news-updates/create')->assertOk();
        $this->get('/admin/looker-studios')->assertOk();
        $this->get('/admin/looker-studios/create')->assertForbidden();
        $this->get('/admin/users')->assertForbidden();
        $this->get('/admin/shield/roles')->assertForbidden();
    }

    public function test_viewer_is_read_only(): void
    {
        $this->actingAs($this->createAdmin(RoleSeeder::VIEWER));
        $news = NewsUpdate::factory()->create();

        $this->get('/admin/news-updates')->assertOk();
        $this->get('/admin/news-updates/create')->assertForbidden();
        $this->get("/admin/news-updates/{$news->getRouteKey()}/edit")->assertForbidden();
        $this->get('/admin/users')->assertForbidden();
    }

    public function test_news_requires_title_and_content(): void
    {
        $this->actingAs($this->createAdmin());

        Livewire::test(CreateNewsUpdate::class)
            ->fillForm(['title' => '', 'content' => ''])
            ->call('create')
            ->assertHasFormErrors(['title' => 'required', 'content' => 'required']);
    }

    public function test_news_is_created_with_details_slug_and_author(): void
    {
        $admin = $this->createAdmin();
        $this->actingAs($admin);

        Livewire::test(CreateNewsUpdate::class)
            ->fillForm([
                'title' => 'Imunisasi Gratis di Posyandu',
                'category' => NewsCategory::Activity->value,
                'excerpt' => 'Jadwal imunisasi bulan ini.',
                'content' => 'Isi **berita**.',
                'status' => NewsStatus::Published->value,
                'is_featured' => true,
                'source_name' => 'Dinas Kesehatan',
                'source_url' => 'https://example.go.id/berita',
            ])
            ->call('create')
            ->assertHasNoFormErrors();

        $news = NewsUpdate::firstOrFail();
        $this->assertSame('imunisasi-gratis-di-posyandu', $news->slug);
        $this->assertSame(NewsCategory::Activity, $news->category);
        $this->assertTrue($news->is_featured);
        $this->assertSame($admin->id, $news->author_id);
        $this->assertNotNull($news->published_at);
    }

    public function test_news_slug_is_unique_and_source_url_must_be_https(): void
    {
        $this->actingAs($this->createAdmin());
        NewsUpdate::factory()->create(['title' => 'Sama', 'slug' => 'sama']);

        Livewire::test(CreateNewsUpdate::class)
            ->fillForm(['title' => 'Lain', 'slug' => 'sama', 'content' => 'x', 'source_url' => 'http://insecure.example'])
            ->call('create')
            ->assertHasFormErrors(['slug' => 'unique', 'source_url']);
    }

    public function test_news_can_be_deleted_from_table(): void
    {
        $this->actingAs($this->createAdmin());
        $news = NewsUpdate::factory()->create();

        Livewire::test(ListNewsUpdates::class)
            ->callAction(TestAction::make('delete')->table($news));

        $this->assertModelMissing($news);
    }

    public function test_looker_url_must_be_a_looker_studio_url(): void
    {
        $this->actingAs($this->createAdmin());

        Livewire::test(CreateLookerStudio::class)
            ->fillForm(['url' => 'https://evil.example.com/x'])
            ->call('create')
            ->assertHasFormErrors(['url']);

        Livewire::test(CreateLookerStudio::class)
            ->fillForm(['url' => 'not-a-url'])
            ->call('create')
            ->assertHasFormErrors(['url']);

        Livewire::test(CreateLookerStudio::class)
            ->fillForm(['url' => 'https://lookerstudio.google.com/embed/reporting/abc/page/1'])
            ->call('create')
            ->assertHasNoFormErrors();

        $this->assertSame(1, LookerStudio::count());
    }

    public function test_admin_is_created_with_hashed_password_unique_username_and_role(): void
    {
        $this->actingAs($this->createAdmin(attributes: ['username' => 'root']));
        $editor = Role::findByName(RoleSeeder::EDITOR);

        Livewire::test(CreateUser::class)
            ->fillForm(['username' => 'root', 'password' => 'longenough', 'roles' => [$editor->id]])
            ->call('create')
            ->assertHasFormErrors(['username' => 'unique']);

        Livewire::test(CreateUser::class)
            ->fillForm(['username' => 'short', 'password' => '123', 'roles' => [$editor->id]])
            ->call('create')
            ->assertHasFormErrors(['password']);

        Livewire::test(CreateUser::class)
            ->fillForm(['username' => 'noroles', 'password' => 'longenough', 'roles' => []])
            ->call('create')
            ->assertHasFormErrors(['roles']);

        Livewire::test(CreateUser::class)
            ->fillForm(['username' => 'newadmin', 'password' => 'longenough', 'roles' => [$editor->id]])
            ->call('create')
            ->assertHasNoFormErrors();

        $created = User::where('username', 'newadmin')->firstOrFail();
        $this->assertTrue(Hash::check('longenough', $created->password));
        $this->assertTrue($created->hasRole(RoleSeeder::EDITOR));
    }

    public function test_blank_password_on_edit_keeps_existing_password(): void
    {
        $this->actingAs($this->createAdmin());
        $target = User::factory()->create(['password' => 'original-pass']);
        $target->assignRole(RoleSeeder::VIEWER);

        Livewire::test(EditUser::class, ['record' => $target->getRouteKey()])
            ->fillForm(['username' => 'renamed', 'password' => ''])
            ->call('save')
            ->assertHasNoFormErrors();

        $target->refresh();
        $this->assertSame('renamed', $target->username);
        $this->assertTrue(Hash::check('original-pass', $target->password));
    }

    public function test_create_admin_command_assigns_role(): void
    {
        $this->artisan('app:create-admin', ['username' => 'cli'])
            ->expectsQuestion('Password (min. 8 characters)', 'cli-password')
            ->assertSuccessful();

        $this->assertTrue(User::where('username', 'cli')->firstOrFail()->hasRole(RoleSeeder::SUPER_ADMIN));

        $this->artisan('app:create-admin', ['username' => 'writer', '--role' => 'editor'])
            ->expectsQuestion('Password (min. 8 characters)', 'cli-password')
            ->assertSuccessful();

        $this->assertTrue(User::where('username', 'writer')->firstOrFail()->hasRole(RoleSeeder::EDITOR));
    }

    public function test_create_admin_command_rejects_unknown_role(): void
    {
        $this->artisan('app:create-admin', ['username' => 'x', '--role' => 'root'])->assertFailed();

        $this->assertDatabaseMissing('users', ['username' => 'x']);
    }

    public function test_old_adminlte_routes_are_gone(): void
    {
        foreach (['/Admin', '/Regis', '/dashboard', '/KabarTerkini', '/LookerStudio', '/InfoAdmin'] as $path) {
            $this->get($path)->assertNotFound();
        }
    }
}
