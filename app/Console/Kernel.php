<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

use App\Models\Dispositivo;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('iniciar:sistema')->onOneServer();

        $dispositivos = Dispositivo::select('id')->whereActivo(true)->get();

        foreach($dispositivos as $dispositivo)
        {
            $schedule->command("sisad:get-info-equipo-$dispositivo->id")
                ->runInBackground()
                ->onOneServer();
        }
    }

    protected function scheduleTimezone()
    {
        return 'America/Havana';
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}