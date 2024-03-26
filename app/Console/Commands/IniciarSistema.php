<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

use App\Models\Dispositivo;

class IniciarSistema extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'iniciar:sistema';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Iniciar el servicio de encuesta de la apliación.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $dispositivos = Dispositivo::whereActivo(true)->get();

        foreach($dispositivos as $dispositivo)
        {
            $command = '<?php

    namespace App\Console\Commands;

    use Illuminate\Console\Command;

    use App\Http\Controllers\GetInfoAlarmaController;
    use App\Http\Controllers\GetInfoEquipoController;
    use App\Http\Controllers\GetInfoGraficaController;

    class GetInfoEquipo'.$dispositivo->id.' extends Command
    {
        protected $signature = "sisad:get-info-equipo-'.$dispositivo->id.'";

        protected $description = "Obetener información del Equipo '.$dispositivo->nombre.'";

        public function handle()
        {
            $start = time();
            $now = time();

            while(($now - $start) < 55)
            {
                sleep(5);
                $now = time();

                $getInfoAlarma = new GetInfoAlarmaController('.$dispositivo->id.');
                $getInfoGrafica = new GetInfoGraficaController('.$dispositivo->id.');
            }

            $getInfoEquipo = new GetInfoEquipoController('.$dispositivo->id.');
        }
    }
            ';

            $archivo = fopen(base_path().'/app/console/commands/GetInfoEquipo'.$dispositivo->id.'.php', 'w');
            fputs($archivo, $command);
        }
    }
}
