<?php

namespace App\Http\Controllers\Sistema;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Sistema;
use App\Models\LogsSistema;
use Illuminate\Support\Facades\Log;

class SistemaController extends Controller
{
    //Iniciar Sistema
    public function iniciar()
    {
        try {
            if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
                $path = base_path().'\iniciar.bat';
                shell_exec("schtasks  /create /sc minute /tn SisadSystemStarter /tr $path");
                shell_exec('schtasks /run /tn SisadSystemStarter');
                if($sistema = Sistema::first())
                {
                    $sistema->update(['status' => true]);
                } else {
                    Sistema::create([ 'status' => true ]);
                }
            } else {
                exec('cd /d '.base_path().' php artisan iniciar:sistema');
                exec('cd /d '.base_path().' php artisan schedule:run 1>> NUL 2>&1');
                exec('cd /d '.base_path().' php artisan queue:work');
            }
            $this->addLogSistema('success', 'Sistema iniciado correctamente.');
            toastr()->success('Sistema iniciado correctamente.');
        } catch (\Throwable $th) {
            Log::info("Iniciar Sistema");
            Log::notice($th->getMessage());
            toastr()->error('Error al crear la tarea.<br>'.$th->getMessage());
        }

        return redirect()->back();
    }

    //Detener Sistema
    public function detener()
    {
        try {
            if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
                shell_exec("SCHTASKS /Delete /TN SisadSystemStarter /F");
                $sistema = Sistema::first()->update(['status' => false]);
                toastr()->success('El sistema se ha detenido correctamente.<br>');
            } else {

            }
        } catch (\Throwable $th) {
            toastr()->error('Error al detener la tarea del sistema.<br>'.$th);
        }

        return redirect()->back();
    }

    //Añadir Logs al Sistema
    public function addLogSistema($actions, $message)
    {
        LogsSistema::create([
            'user_id' => Auth::id(),
            'actions' => $actions,
            'message' => $message
        ]);
    }
}