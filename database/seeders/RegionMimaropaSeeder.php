<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Division;
use App\Models\Municipality;

class RegionMimaropaSeeder extends Seeder
{
    public function run(): void
    {
        // Create division
        $division = Division::firstOrCreate([
            'division_name' => 'Region IV-B MIMAROPA',
        ]);

        // Sample municipalities under Region IV-B
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

        $this->command->info('Division and Municipalities for Region IV-B MIMAROPA seeded.');
    }
}
