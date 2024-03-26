<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->truncateTablas([
            'roles',
            'users',
            'plantillas',
            'plantilla_oids',
            'provincias',
            'municipios',
            'ubicacions',
        ]);

        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            PlantillaSeeder::class,
            PlantillaRoverMrx200Seeder::class,
            PlantillaRoverMfe802Seeder::class,
            ProvinciaSeeder::class,
            MunicipioSeeder::class,
            UbicacionSeeder::class
        ]);
    }

    public function truncateTablas(array $tablas) {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        foreach($tablas as $tabla) {
            DB::table($tabla)->truncate();
        }

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
