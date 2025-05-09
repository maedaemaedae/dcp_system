<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RegionMimaropaSeeder extends Seeder
{
    public function run(): void
    {
        // Insert Regional Office
        DB::table('regional_offices')->insert([
            'ro_id' => 1,
            'ro_office' => 'Region IV-B MIMAROPA',
            'person_in_charge' => 'N/A',
            'email' => 'ro_mimaropa@example.com',
            'contact_no' => '0000000000',
            'created_by' => 'Seeder',
            'created_date' => Carbon::now(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // Insert Division Offices
        DB::table('division_offices')->insert([
            [
                'division_id' => 1,
                'division_name' => 'Palawan',
                'regional_office_id' => 1,
                'person_in_charge' => 'N/A',
                'email' => 'palawan@example.com',
                'contact_no' => '0000000000',
                'created_by' => 'Seeder',
                'created_date' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'division_id' => 2,
                'division_name' => 'Marinduque',
                'regional_office_id' => 1,
                'person_in_charge' => 'N/A',
                'email' => 'marinduque@example.com',
                'contact_no' => '0000000000',
                'created_by' => 'Seeder',
                'created_date' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'division_id' => 3,
                'division_name' => 'Occidental Mindoro',
                'regional_office_id' => 1,
                'person_in_charge' => 'N/A',
                'email' => 'occmin@example.com',
                'contact_no' => '0000000000',
                'created_by' => 'Seeder',
                'created_date' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'division_id' => 4,
                'division_name' => 'Oriental Mindoro',
                'regional_office_id' => 1,
                'person_in_charge' => 'N/A',
                'email' => 'ormin@example.com',
                'contact_no' => '0000000000',
                'created_by' => 'Seeder',
                'created_date' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'division_id' => 5,
                'division_name' => 'Romblon',
                'regional_office_id' => 1,
                'person_in_charge' => 'N/A',
                'email' => 'romblon@example.com',
                'contact_no' => '0000000000',
                'created_by' => 'Seeder',
                'created_date' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'division_id' => 6,
                'division_name' => 'City of Calapan',
                'regional_office_id' => 1,
                'person_in_charge' => 'N/A',
                'email' => 'calapan@example.com',
                'contact_no' => '0000000000',
                'created_by' => 'Seeder',
                'created_date' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'division_id' => 7,
                'division_name' => 'Puerto Princesa City',
                'regional_office_id' => 1,
                'person_in_charge' => 'N/A',
                'email' => 'puertoprincesa@example.com',
                'contact_no' => '0000000000',
                'created_by' => 'Seeder',
                'created_date' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
