<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

/**
 * Roles used by the admin panel (Filament Shield).
 *
 * - super_admin: full access (bypasses policies via Shield).
 * - editor:      manage news, view Looker Studio.
 * - viewer:      read-only access to news and Looker Studio.
 *
 * Idempotent: safe to run on every deploy. Run `php artisan shield:generate --all`
 * first so the permissions exist after adding a new resource.
 */
class RoleSeeder extends Seeder
{
    public const SUPER_ADMIN = 'super_admin';

    public const EDITOR = 'editor';

    public const VIEWER = 'viewer';

    /**
     * @var array<string, array<int, string>>
     */
    private const ROLE_PERMISSIONS = [
        self::EDITOR => [
            'ViewAny:NewsUpdate', 'View:NewsUpdate', 'Create:NewsUpdate', 'Update:NewsUpdate',
            'Delete:NewsUpdate', 'DeleteAny:NewsUpdate',
            'ViewAny:LookerStudio', 'View:LookerStudio',
        ],
        self::VIEWER => [
            'ViewAny:NewsUpdate', 'View:NewsUpdate',
            'ViewAny:LookerStudio', 'View:LookerStudio',
        ],
    ];

    public function run(): void
    {
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        Role::findOrCreate(self::SUPER_ADMIN, 'web');

        foreach (self::ROLE_PERMISSIONS as $name => $permissions) {
            $role = Role::findOrCreate($name, 'web');

            $role->syncPermissions(
                collect($permissions)->map(fn (string $permission) => Permission::findOrCreate($permission, 'web'))
            );
        }
    }
}
