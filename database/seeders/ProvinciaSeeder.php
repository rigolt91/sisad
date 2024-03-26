<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Provincia;

class ProvinciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Provincia::create([
            'nombre' => 'Las Tunas',
        ]);

        Provincia::create([
            'nombre' => 'Camaguey'
        ]);
    }
}
