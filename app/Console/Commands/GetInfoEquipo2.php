<?php

    namespace App\Console\Commands;

    use Illuminate\Console\Command;

    use App\Http\Controllers\GetInfoAlarmaController;
    use App\Http\Controllers\GetInfoEquipoController;
    use App\Http\Controllers\GetInfoGraficaController;

    class GetInfoEquipo2 extends Command
    {
        protected $signature = "sisad:get-info-equipo-2";

        protected $description = "Obetener información del Equipo Rover MRX 200 - COM El Fuerte";

        public function handle()
        {
            $start = time();
            $now = time();

            while(($now - $start) < 55)
            {
                sleep(5);
                $now = time();

                $getInfoAlarma = new GetInfoAlarmaController(2);
                $getInfoGrafica = new GetInfoGraficaController(2);
            }

            $getInfoEquipo = new GetInfoEquipoController(2);
        }
    }
            