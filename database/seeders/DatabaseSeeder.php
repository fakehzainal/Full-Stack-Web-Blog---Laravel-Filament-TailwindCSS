<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::query()->updateOrCreate(
            ['email' => 'admin@blog.test'],
            [
                'name' => 'Admin',
                'role' => User::ROLE_ADMIN,
                'password' => 'password',
                'email_verified_at' => now(),
            ]
        );

        User::query()->updateOrCreate(
            ['email' => 'penulis@blog.test'],
            [
                'name' => 'Penulis',
                'role' => User::ROLE_PENULIS,
                'password' => 'password',
                'email_verified_at' => now(),
            ]
        );
    }
}
