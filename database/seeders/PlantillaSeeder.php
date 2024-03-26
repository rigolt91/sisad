<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Plantilla;

class PlantillaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->create([
            'Rover Mrx 200',
            'Rover Mfe 802'
        ]);
    }

    public function create($plantillas)
    {
        foreach ($plantillas as $plantilla) {
            Plantilla::create([
                'nombre' => $plantilla
            ]);
        }
    }
}
