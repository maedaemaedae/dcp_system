<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ✅ Step 1: Seed roles
        $this->call([
            RoleSeeder::class,
        ]);

        // ✅ Step 2: Create Super Admin
        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@example.com',
            'password' => Hash::make('pasword'),
            'role_id' => 1,
        ]);

        // ✅ Step 3: Create Supplier
        User::create([
            'name' => 'Supplier 1',
            'email' => 'supplier1@example.com',
            'password' => Hash::make('password'),
            'role_id' => 6,
            'is_activated' => true,
        ]);

        User::create([
            'name' => 'Supplier 2',
            'email' => 'supplier2@example.com',
            'password' => Hash::make('password'),
            'role_id' => 6,
            'is_activated' => true,
        ]);

        User::create([
            'name' => 'Supplier 3',
            'email' => 'supplier3@example.com',
            'password' => Hash::make('password'),
            'role_id' => 6,
            'is_activated' => true,
        ]);

        // ✅ Step 3: Create School/Division Office Representative
        User::create([
            'name' => 'Division Office Representative',
            'email' => 'divisionrepresentative@example.com',
            'password' => Hash::make('password'),
            'role_id' => 4,
            'is_activated' => true,
        ]);

        User::create([
            'name' => 'School Representative',
            'email' => 'schoolrepresentative@example.com',
            'password' => Hash::make('password'),
            'role_id' => 5,
            'is_activated' => true,
        ]);

        // ✅ Step 4: Other seeders
        $this->call([
            UnifiedSeeder::class,
            // SchoolSeeder::class,
        ]);
    }
}
