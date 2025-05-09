<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\DivisionOffice;

class MunicipalitySeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['division_name' => 'Marinduque', 'municipality_name' => 'Boac'],
            ['division_name' => 'Marinduque', 'municipality_name' => 'Buenavista'],
            ['division_name' => 'Marinduque', 'municipality_name' => 'Gasan'],
            ['division_name' => 'Marinduque', 'municipality_name' => 'Mogpog'],
            ['division_name' => 'Marinduque', 'municipality_name' => 'Santa Cruz'],
            ['division_name' => 'Marinduque', 'municipality_name' => 'Torrijos'],

            ['division_name' => 'Occidental Mindoro', 'municipality_name' => 'Abra de Ilog'],
            ['division_name' => 'Occidental Mindoro', 'municipality_name' => 'Calintaan'],
            ['division_name' => 'Occidental Mindoro', 'municipality_name' => 'Looc'],
            ['division_name' => 'Occidental Mindoro', 'municipality_name' => 'Lubang'],
            ['division_name' => 'Occidental Mindoro', 'municipality_name' => 'Magsaysay'],
            ['division_name' => 'Occidental Mindoro', 'municipality_name' => 'Mamburao'],
            ['division_name' => 'Occidental Mindoro', 'municipality_name' => 'Paluan'],
            ['division_name' => 'Occidental Mindoro', 'municipality_name' => 'Rizal'],
            ['division_name' => 'Occidental Mindoro', 'municipality_name' => 'Sablayan'],
            ['division_name' => 'Occidental Mindoro', 'municipality_name' => 'San Jose'],
            ['division_name' => 'Occidental Mindoro', 'municipality_name' => 'Santa Cruz'],

            ['division_name' => 'Oriental Mindoro', 'municipality_name' => 'Baco'],
            ['division_name' => 'Oriental Mindoro', 'municipality_name' => 'Bansud'],
            ['division_name' => 'Oriental Mindoro', 'municipality_name' => 'Bongabong'],
            ['division_name' => 'Oriental Mindoro', 'municipality_name' => 'Bulalacao'],
            ['division_name' => 'Oriental Mindoro', 'municipality_name' => 'City of Calapan'],
            ['division_name' => 'Oriental Mindoro', 'municipality_name' => 'Gloria'],
            ['division_name' => 'Oriental Mindoro', 'municipality_name' => 'Mansalay'],
            ['division_name' => 'Oriental Mindoro', 'municipality_name' => 'Naujan'],
            ['division_name' => 'Oriental Mindoro', 'municipality_name' => 'Pinamalayan'],
            ['division_name' => 'Oriental Mindoro', 'municipality_name' => 'Pola'],
            ['division_name' => 'Oriental Mindoro', 'municipality_name' => 'Puerto Galera'],
            ['division_name' => 'Oriental Mindoro', 'municipality_name' => 'Roxas'],
            ['division_name' => 'Oriental Mindoro', 'municipality_name' => 'San Teodoro'],
            ['division_name' => 'Oriental Mindoro', 'municipality_name' => 'Socorro'],
            ['division_name' => 'Oriental Mindoro', 'municipality_name' => 'Victoria'],

            ['division_name' => 'Palawan', 'municipality_name' => 'Aborlan'],
            ['division_name' => 'Palawan', 'municipality_name' => 'Agutaya'],
            ['division_name' => 'Palawan', 'municipality_name' => 'Araceli'],
            ['division_name' => 'Palawan', 'municipality_name' => 'Balabac'],
            ['division_name' => 'Palawan', 'municipality_name' => 'Bataraza'],
            ['division_name' => 'Palawan', 'municipality_name' => 'Brooke\'s Point'],
            ['division_name' => 'Palawan', 'municipality_name' => 'Busuanga'],
            ['division_name' => 'Palawan', 'municipality_name' => 'Cagayancillo'],
            ['division_name' => 'Palawan', 'municipality_name' => 'Coron'],
            ['division_name' => 'Palawan', 'municipality_name' => 'Culion'],
            ['division_name' => 'Palawan', 'municipality_name' => 'Cuyo'],
            ['division_name' => 'Palawan', 'municipality_name' => 'Dumaran'],
            ['division_name' => 'Palawan', 'municipality_name' => 'El Nido'],
            ['division_name' => 'Palawan', 'municipality_name' => 'Kalayaan'],
            ['division_name' => 'Palawan', 'municipality_name' => 'Linapacan'],
            ['division_name' => 'Palawan', 'municipality_name' => 'Magsaysay'],
            ['division_name' => 'Palawan', 'municipality_name' => 'Narra'],
            ['division_name' => 'Palawan', 'municipality_name' => 'Puerto Princesa City'],
            ['division_name' => 'Palawan', 'municipality_name' => 'Quezon'],
            ['division_name' => 'Palawan', 'municipality_name' => 'Rizal'],
            ['division_name' => 'Palawan', 'municipality_name' => 'Roxas'],
            ['division_name' => 'Palawan', 'municipality_name' => 'San Vicente'],
            ['division_name' => 'Palawan', 'municipality_name' => 'Sofronio Española'],
            ['division_name' => 'Palawan', 'municipality_name' => 'Taytay'],

            ['division_name' => 'Romblon', 'municipality_name' => 'Alcantara'],
            ['division_name' => 'Romblon', 'municipality_name' => 'Banton'],
            ['division_name' => 'Romblon', 'municipality_name' => 'Cajidiocan'],
            ['division_name' => 'Romblon', 'municipality_name' => 'Calatrava'],
            ['division_name' => 'Romblon', 'municipality_name' => 'Concepcion'],
            ['division_name' => 'Romblon', 'municipality_name' => 'Corcuera'],
            ['division_name' => 'Romblon', 'municipality_name' => 'Ferrol'],
            ['division_name' => 'Romblon', 'municipality_name' => 'Looc'],
            ['division_name' => 'Romblon', 'municipality_name' => 'Magdiwang'],
            ['division_name' => 'Romblon', 'municipality_name' => 'Odiongan'],
            ['division_name' => 'Romblon', 'municipality_name' => 'Romblon'],
            ['division_name' => 'Romblon', 'municipality_name' => 'San Agustin'],
            ['division_name' => 'Romblon', 'municipality_name' => 'San Andres'],
            ['division_name' => 'Romblon', 'municipality_name' => 'San Fernando'],
            ['division_name' => 'Romblon', 'municipality_name' => 'San Jose'],
            ['division_name' => 'Romblon', 'municipality_name' => 'Santa Fe'],
            ['division_name' => 'Romblon', 'municipality_name' => 'Santa Maria'],
        ];

        foreach ($data as $index => $item) {
            $division = DivisionOffice::where('division_name', $item['division_name'])->first();
        
            if ($division) {
                DB::table('municipalities')->insert([
                    'municipality_id' => $index + 1, // or any unique ID logic
                    'municipality_name' => $item['municipality_name'],
                    'division_id' => $division->division_id
                ]);
            }
        }
        
    }
}
