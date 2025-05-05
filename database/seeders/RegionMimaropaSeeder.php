<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RegionalOffice;
use App\Models\DivisionOffice;
use App\Models\Municipality;

class RegionMimaropaSeeder extends Seeder
{
    public function run(): void
    {
        // Ensure clean match for Regional Office
        $region = RegionalOffice::firstOrCreate(
            ['ro_id' => 1, 'ro_office' => 'Region IV-B MIMAROPA'],
            [
                'person_in_charge' => 'N/A',
                'email' => 'ro_mimaropa@example.com',
                'contact_no' => '0000000000',
                'created_by' => 'Seeder',
                'created_date' => now(),
            ]
        );
    
        if (!$region || !$region->ro_id) {
            throw new \Exception("❌ Failed to retrieve or create Region IV-B MIMAROPA.");
        }
    
        // Proceed to create division offices
        $divisions = [
            'Palawan',
            'Romblon',
            'Marinduque',
            'Oriental Mindoro',
            'Occidental Mindoro',
            'Puerto Princesa City',
            'Calapan City',
        ];
    
        foreach ($divisions as $divisionName) {
            DivisionOffice::firstOrCreate(
                ['division_name' => $divisionName],
                [
                    'regional_office_id' => $region->ro_id,
                    'person_in_charge' => 'N/A',
                    'email' => strtolower(str_replace(' ', '', $divisionName)) . '@example.com',
                    'contact_no' => '0000000000',
                    'created_by' => 'Seeder',
                    'created_date' => now(),
                ]
            );
        }
    
        // Create municipalities
        $municipalities = [
            'Puerto Princesa',
            'San Jose',
            'Brooke’s Point',
            'Calapan',
            'Roxas',
            'Sablayan',
            'Coron',
            'Pinamalayan',
        ];
    
        foreach ($municipalities as $name) {
            Municipality::firstOrCreate([
                'municipality_name' => $name,
            ]);
        }
    
        $this->command->info('✅ Region IV-B MIMAROPA, its divisions, and municipalities seeded successfully.');
    }
    
    }

