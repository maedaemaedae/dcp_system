<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RegionalOffice;
use App\Models\DivisionOffice;
use App\Models\School;
use App\Models\Project;
use App\Models\Package;
use App\Models\PackageContent;
use App\Models\PackageType;
use App\Models\Recipient;

class UnifiedSeeder extends Seeder
{
    public function run(): void
    {
        // Regional Offices
        RegionalOffice::insert([
            [
                'ro_id' => 1,
                'ro_office' => 'MIMAROPA Regional Office',
                'ro_address' => 'Calapan City',
                'person_in_charge' => 'Director Maria Lopez',
                'email' => 'maria.lopez@deped.gov.ph',
                'contact_no' => '09191234567',
                'created_by' => 'Seeder',
                'created_date' => now(),
                'modified_by' => null,
                'modified_date' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);

        // Division Offices
        DivisionOffice::insert([
            [
                'division_id' => 1,
                'division_name' => 'Palawan',
                'regional_office_id' => 1,
                'sdo_address' => 'Puerto Princesa City',
                'office' => 'Palawan Regional Office',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

        // Schools
        School::insert([
            [
                'school_id' => 101,
                'division_id' => 1,
                'school_name' => 'Calapan Elementary School',
                'school_address' => 'Calapan City',
                'has_internet' => true,
                'internet_provider' => 'PLDT',
                'electricity_provider' => 'Meralco',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'school_id' => 102,
                'division_id' => 1,
                'school_name' => 'Roxas National High School',
                'school_address' => 'Roxas, Palawan',
                'has_internet' => false,
                'internet_provider' => null,
                'electricity_provider' => 'Paleco',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

        // Projects
        Project::insert([
            [
                'name' => 'Digital Education Rollout Phase 1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'DepEd ICT Enhancement 2024',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
        
        // Package Types
        PackageType::insert([
            [
                'id' => 1,
                'package_code' => 'L4T',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'package_code' => 'STV',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'package_code' => 'L4NT',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        // Package Content
        PackageContent::insert([
        [
            'package_type_id' => 1, // L4T
            'item_name' => 'Laptop',
            'quantity' => 30,
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'package_type_id' => 1, // L4T
            'item_name' => 'Router',
            'quantity' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'package_type_id' => 2, // STV
            'item_name' => 'Smart TV',
            'quantity' => 2,
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'package_type_id' => 3, // L4NT
            'item_name' => 'Tablet',
            'quantity' => 50,
            'created_at' => now(),
            'updated_at' => now()
        ],
    ]);

        // Packages
        Package::insert([
            [
                'id' => 1,
                'project_id' => 1,
                'package_type_id' => 1,
                'description' => 'PKG-MIM-001',
                'project_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

        // Recipients
        Recipient::insert([
            [
                'package_id' => 1,
                'recipient_type' => 'school',
                'recipient_id' => 101,
                'contact_person' => 'Mr. Juan Dela Cruz',
                'quantity' => 3,
                'position' => 'Principal',
                'contact_number' => '09170001111',
                'created_by' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
