<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            ['role_id' => 1, 'role_name' => 'Super Admin'],
            ['role_id' => 2, 'role_name' => 'Admin'],
            ['role_id' => 3, 'role_name' => 'Regional Office Representative'],
            ['role_id' => 4, 'role_name' => 'Division Office Representative'],
            ['role_id' => 5, 'role_name' => 'School Representative'],
            ['role_id' => 6, 'role_name' => 'Supplier'],
            ['role_id' => 7, 'role_name' => 'User'], // 👈 NEW ROLE
        ];
    
        foreach ($roles as $role) {
            DB::table('roles')->updateOrInsert(
                ['role_id' => $role['role_id']],
                $role
            );
        }
    }
}    