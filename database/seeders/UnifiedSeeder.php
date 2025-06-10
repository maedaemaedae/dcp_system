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
        // Projects
        Project::insert([
            [
                'name' => 'DCP L4T 2025',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'DCP STV 2025',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'DCP L4NT 2025',
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
            ],
            [
                'id' => 2,
                'project_id' => 2,
                'package_type_id' => 2,
                'description' => 'PKG-MIM-002',
                'project_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
                        [
                'id' => 3,
                'project_id' => 3,
                'package_type_id' => 3,
                'description' => 'PKG-MIM-003',
                'project_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

        // Package Content
        PackageContent::insert([
        [
            'package_type_id' => 1, // L4T
            'item_name' => 'Laptop',
            'quantity' => 5,
            'created_at' => now(),
            'updated_at' => now(),
            'package_id' => 1,
        ],
        [
            'package_type_id' => 2, // STV
            'item_name' => 'Smart TV',
            'quantity' => 5,
            'created_at' => now(),
            'updated_at' => now(),
            'package_id' => 2,
        ],
        [
            'package_type_id' => 2, // STV
            'item_name' => 'External Hard Drive',
            'quantity' => 5,
            'created_at' => now(),
            'updated_at' => now(),
            'package_id' => 2,
        ],
             [
            'package_type_id' => 3, // L4NT
            'item_name' => 'Laptop',
            'quantity' => 1,
            'created_at' => now(),
            'updated_at' => now(),
            'package_id' => 3,
        ],
    ]);


    }
}
