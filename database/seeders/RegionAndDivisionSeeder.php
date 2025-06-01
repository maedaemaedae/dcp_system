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
                'ro_office' => 'MIMAROPA Region',
                'ro_address' => 'Calapan City, Oriental Mindoro',
                'person_in_charge' => 'Mr. Regional Director',
                'email' => 'director@mimaropa.deped.gov.ph',
                'contact_no' => '09171234567',
                'created_by' => 'Seeder',
                'created_date' => Carbon::now(),
                'modified_by' => null,
                'modified_date' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);

        // Seed Division Offices under Region IV-B
        $divisions = [
            ['division_id' => 1001, 'division_name' => 'Calapan City', 'office' => 'Calapan Division Office', 'sdo_address' => 'Brgy. San Vicente East, Calapan City'],
            ['division_id' => 1002, 'division_name' => 'Marinduque', 'office' => 'Marinduque Division Office', 'sdo_address' => 'Boac, Marinduque'],
            ['division_id' => 1003, 'division_name' => 'Occidental Mindoro', 'office' => 'Occidental Mindoro Division', 'sdo_address' => 'Mamburao, Occidental Mindoro'],
            ['division_id' => 1004, 'division_name' => 'Oriental Mindoro', 'office' => 'Oriental Mindoro Division', 'sdo_address' => 'Calapan City, Oriental Mindoro'],
            ['division_id' => 1005, 'division_name' => 'Palawan', 'office' => 'Palawan Division Office', 'sdo_address' => 'Puerto Princesa City, Palawan'],
            ['division_id' => 1006, 'division_name' => 'Puerto Princesa City', 'office' => 'Puerto Princesa Division', 'sdo_address' => 'Puerto Princesa, Palawan'],
            ['division_id' => 1007, 'division_name' => 'Romblon', 'office' => 'Romblon Division Office', 'sdo_address' => 'Romblon, Romblon'],
        ];

        foreach ($divisions as $division) {
            DB::table('division_offices')->insert([
                'division_id' => $division['division_id'],
                'division_name' => $division['division_name'],
                'regional_office_id' => 1,
                'office' => $division['office'],
                'sdo_address' => $division['sdo_address'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
