<?php

namespace Tests\Concerns;

use App\Models\User;
use Database\Seeders\RoleSeeder;

trait CreatesAdmins
{
    protected function createAdmin(string $role = RoleSeeder::SUPER_ADMIN, array $attributes = []): User
    {
        $this->seed(RoleSeeder::class);

        $user = User::factory()->create($attributes);
        $user->assignRole($role);

        return $user;
    }
}
