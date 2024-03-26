<?php

    namespace App\Console\Commands;

    use Illuminate\Console\Command;

    use App\Http\Controllers\GetInfoAlarmaController;
    use App\Http\Controllers\GetInfoEquipoController;
    use App\Http\Controllers\GetInfoGraficaController;

    class GetInfoEquipo1 extends Command
    {
        protected $signature = "sisad:get-info-equipo-1";

        protected $description = "Obetener información del Equipo Rover MFE 802 - Puerto Padre";

        public function handle()
        {
            $start = time();
            $now = time();

            while(($now - $start) < 55)
            {
                sleep(5);
                $now = time();

                $getInfoAlarma = new GetInfoAlarmaController(1);
                $getInfoGrafica = new GetInfoGraficaController(1);
            }

            $getInfoEquipo = new GetInfoEquipoController(1);
        }
    }
            