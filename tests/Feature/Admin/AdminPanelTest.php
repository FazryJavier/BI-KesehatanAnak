<?php

namespace Tests\Feature\Admin;

use App\Filament\Pages\Login;
use App\Filament\Resources\LookerStudios\Pages\CreateLookerStudio;
use App\Filament\Resources\NewsUpdates\Pages\CreateNewsUpdate;
use App\Filament\Resources\NewsUpdates\Pages\ListNewsUpdates;
use App\Filament\Resources\Users\Pages\CreateUser;
use App\Filament\Resources\Users\Pages\EditUser;
use App\Models\LookerStudio;
use App\Models\NewsUpdate;
use App\Models\User;
use Filament\Actions\Testing\TestAction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Livewire\Livewire;
use Tests\TestCase;

class AdminPanelTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_are_redirected_to_login(): void
    {
        foreach (['/admin', '/admin/news-updates', '/admin/looker-studios', '/admin/users'] as $path) {
            $this->get($path)->assertRedirect('/admin/login');
        }
    }

    public function test_login_page_renders(): void
    {
        $this->get('/admin/login')->assertOk();
    }

    public function test_admin_can_log_in_with_username(): void
    {
        $user = User::factory()->create(['username' => 'jane', 'password' => 'secret-pass']);

        Livewire::test(Login::class)
            ->fillForm(['username' => 'jane', 'password' => 'secret-pass'])
            ->call('authenticate')
            ->assertHasNoFormErrors();

        $this->assertAuthenticatedAs($user);
    }

    public function test_login_fails_with_wrong_password(): void
    {
        User::factory()->create(['username' => 'jane', 'password' => 'secret-pass']);

        Livewire::test(Login::class)
            ->fillForm(['username' => 'jane', 'password' => 'wrong'])
            ->call('authenticate')
            ->assertHasFormErrors(['username']);

        $this->assertGuest();
    }

    public function test_authenticated_admin_sees_resource_pages(): void
    {
        $this->actingAs(User::factory()->create());

        foreach (['/admin', '/admin/news-updates', '/admin/looker-studios', '/admin/users'] as $path) {
            $this->get($path)->assertOk();
        }
    }

    public function test_news_update_can_be_created_and_requires_content(): void
    {
        $this->actingAs(User::factory()->create());

        Livewire::test(CreateNewsUpdate::class)
            ->fillForm(['content' => ''])
            ->call('create')
            ->assertHasFormErrors(['content' => 'required']);

        Livewire::test(CreateNewsUpdate::class)
            ->fillForm(['content' => 'Hello'])
            ->call('create')
            ->assertHasNoFormErrors();

        $this->assertDatabaseHas('news_updates', ['content' => 'Hello']);
    }

    public function test_news_update_can_be_deleted_from_table(): void
    {
        $this->actingAs(User::factory()->create());
        $news = NewsUpdate::factory()->create();

        Livewire::test(ListNewsUpdates::class)
            ->callAction(TestAction::make('delete')->table($news));

        $this->assertModelMissing($news);
    }

    public function test_looker_url_must_be_a_looker_studio_url(): void
    {
        $this->actingAs(User::factory()->create());

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

    public function test_admin_can_be_created_with_hashed_password_and_unique_username(): void
    {
        $this->actingAs(User::factory()->create(['username' => 'root']));

        Livewire::test(CreateUser::class)
            ->fillForm(['username' => 'root', 'password' => 'longenough'])
            ->call('create')
            ->assertHasFormErrors(['username' => 'unique']);

        Livewire::test(CreateUser::class)
            ->fillForm(['username' => 'short', 'password' => '123'])
            ->call('create')
            ->assertHasFormErrors(['password']);

        Livewire::test(CreateUser::class)
            ->fillForm(['username' => 'newadmin', 'password' => 'longenough'])
            ->call('create')
            ->assertHasNoFormErrors();

        $created = User::where('username', 'newadmin')->firstOrFail();
        $this->assertTrue(Hash::check('longenough', $created->password));
        $this->assertNotSame('longenough', $created->password);
    }

    public function test_blank_password_on_edit_keeps_existing_password(): void
    {
        $this->actingAs(User::factory()->create());
        $target = User::factory()->create(['password' => 'original-pass']);

        Livewire::test(EditUser::class, ['record' => $target->getRouteKey()])
            ->fillForm(['username' => 'renamed', 'password' => ''])
            ->call('save')
            ->assertHasNoFormErrors();

        $target->refresh();
        $this->assertSame('renamed', $target->username);
        $this->assertTrue(Hash::check('original-pass', $target->password));
    }

    public function test_create_admin_command(): void
    {
        $this->artisan('app:create-admin', ['username' => 'cli'])
            ->expectsQuestion('Password (min. 8 characters)', 'cli-password')
            ->assertSuccessful();

        $this->assertDatabaseHas('users', ['username' => 'cli']);
    }

    public function test_old_adminlte_routes_are_gone(): void
    {
        foreach (['/Admin', '/Regis', '/dashboard', '/KabarTerkini', '/LookerStudio', '/InfoAdmin'] as $path) {
            $this->get($path)->assertNotFound();
        }
    }
}
