<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Seed super admin user
        $user = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@example.com',
            'password' => bcrypt('password'),
        ]);

        Role::create([
            'user_id' => $user->id,
            'role_name' => 'super_admin',
        ]);

        // Call Region Seeder
        $this->call(RegionMimaropaSeeder::class);
    }
}
