<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(RegionMimaropaSeeder::class);

        User::firstOrCreate([
            'email' => 'superadmin@example.com',
        ], [
            'name' => 'Super Admin',
            'password' => bcrypt('password'), // or your preferred default
        ]);
        
        Role::create([
            'user_id' => $user->id,
            'role_name' => 'super_admin',
        ]);
    }
}
