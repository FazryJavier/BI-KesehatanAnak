<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;

use function Laravel\Prompts\password;
use function Laravel\Prompts\text;

class CreateAdmin extends Command
{
    protected $signature = 'app:create-admin {username? : Admin username}';

    protected $description = 'Create an admin account for the Filament panel';

    public function handle(): int
    {
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

        User::create(['username' => $username, 'password' => $password]);
        $this->info("Admin \"{$username}\" created.");

        return self::SUCCESS;
    }
}
