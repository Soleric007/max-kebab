<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $email = env('ADMIN_EMAIL', 'admin@maxkebab.co.uk');
        $user = User::firstOrNew(['email' => $email]);

        $user->name = env('ADMIN_NAME', 'Max Kebab Admin');
        $user->role = 'admin';

        if (! $user->exists || empty($user->password)) {
            $user->password = env('ADMIN_PASSWORD', 'MaxKebabAdmin123!');
        }

        $user->save();
    }
}
