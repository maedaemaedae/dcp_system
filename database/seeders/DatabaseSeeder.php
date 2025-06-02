<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Seed roles first
        $this->call([
            RoleSeeder::class,
        ]);

        // 2. Then create the Super Admin user
        $user = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@example.com',
            'password' => Hash::make('password'),
            'role_id' => 1, // safe now because roles table is seeded
        ]);

        $this->call([
            RoleSeeder::class,
            UnifiedSeeder::class,
            //SchoolSeeder::class,
        ]);

    }
}
