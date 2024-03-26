<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Municipio;

class MunicipioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Municipio::create([
            'nombre' => 'Las Tunas',
            'provincia_id' => 1
        ]);

        Municipio::create([
            'nombre' => 'Manatí',
            'provincia_id' => 1
        ]);

        Municipio::create([
            'nombre' => 'Puerto Padre',
            'provincia_id' => 1
        ]);

        Municipio::create([
            'nombre' => 'Menendez',
            'provincia_id' => 1
        ]);

        Municipio::create([
            'nombre' => 'Amancio',
            'provincia_id' => 1
        ]);

        Municipio::create([
            'nombre' => 'Colombia',
            'provincia_id' => 1
        ]);

        Municipio::create([
            'nombre' => 'Jobabo',
            'provincia_id' => 1
        ]);

        Municipio::create([
            'nombre' => 'Majibacoa',
            'provincia_id' => 1
        ]);
    }
}
