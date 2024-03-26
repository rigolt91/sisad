<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Ubicacion;

class UbicacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ubicacion::create([
            'nombre' => 'CTV Las Tunas',
            'municipio_id'  => 1
        ]);

        Ubicacion::create([
            'nombre' => 'CTOM Rebelde 1180',
            'municipio_id'  => 1
        ]);

        Ubicacion::create([
            'nombre' => 'CTOM Progreso',
            'municipio_id'  => 1,
        ]);

        Ubicacion::create([
            'nombre' => 'COM 12 Plantas',
            'municipio_id'  => 1
        ]);
    }
}
