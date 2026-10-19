<?php

namespace App\Console\Commands;

use App\Models\User;
use Database\Seeders\RoleSeeder;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;

use function Laravel\Prompts\password;
use function Laravel\Prompts\text;

class CreateAdmin extends Command
{
    protected $signature = 'app:create-admin
        {username? : Admin username}
        {--role=super_admin : Role to assign (super_admin, editor, viewer)}';

    protected $description = 'Create an admin account for the Filament panel';

    public function handle(): int
    {
        $role = (string) $this->option('role');

        if (! in_array($role, [RoleSeeder::SUPER_ADMIN, RoleSeeder::EDITOR, RoleSeeder::VIEWER], true)) {
            $this->error("Unknown role \"{$role}\". Use super_admin, editor, or viewer.");

            return self::FAILURE;
        }

        $username = $this->argument('username') ?? text('Username', required: true);
        $password = password('Password (min. 8 characters)', required: true);

        $validator = Validator::make(
            ['username' => $username, 'password' => $password],
            ['username' => ['required', 'max:255', 'unique:users,username'], 'password' => ['required', 'min:8']],
        );

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }

            return self::FAILURE;
        }

        $this->callSilently('db:seed', ['--class' => RoleSeeder::class, '--force' => true]);

        $user = User::create(['username' => $username, 'password' => $password]);
        $user->assignRole($role);

        $this->info("Admin \"{$username}\" created with role {$role}.");

        return self::SUCCESS;
    }
}
