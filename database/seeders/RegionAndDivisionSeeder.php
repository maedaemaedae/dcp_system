<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RegionAndDivisionSeeder extends Seeder
{
    public function run(): void
    {
        // Seed Regional Office
        DB::table('regional_offices')->insert([
            [
                'ro_id' => 1,
                'ro_office' => 'Region IV-B MIMAROPA',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);

        // Seed Division Offices under Region IV-B
        $divisions = [
            ['division_id' => 1001, 'division_name' => 'Calapan City'],
            ['division_id' => 1002, 'division_name' => 'Marinduque'],
            ['division_id' => 1003, 'division_name' => 'Occidental Mindoro'],
            ['division_id' => 1004, 'division_name' => 'Oriental Mindoro'],
            ['division_id' => 1005, 'division_name' => 'Palawan'],
            ['division_id' => 1006, 'division_name' => 'Puerto Princesa City'],
            ['division_id' => 1007, 'division_name' => 'Romblon'],
        ];

        foreach ($divisions as $division) {
            DB::table('division_offices')->insert([
                'division_id' => $division['division_id'],
                'division_name' => $division['division_name'],
                'regional_office_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
