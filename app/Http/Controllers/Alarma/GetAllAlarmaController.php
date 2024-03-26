<?php

namespace App\Http\Controllers\Alarma;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Alarma;
use App\Models\Dispositivo;

class GetAllAlarmaController extends Controller
{
    public $date;

    public function setDate($date = null)
    {
        if(is_null($date))
        {
            $this->date = date('Y-m-d');
        } else {
            $this->date = $date;
        }

    }

    public function getData()
    {
        return response()->json([
            'alarmas'  => $this->getAllAlarmas(),
            'status'   => $this->getStatus(),
        ]);
    }

    public function getAllAlarmas()
    {
        $success = Alarma::where('codigo', 1)->orWhere(function($query) { $query->where('codigo', 4); $query->orWhere('codigo', 7); })->count();
        $errors  = Alarma::where('codigo', 0)->orWhere(function($query) { $query->where('codigo', 3); $query->orWhere('codigo', 6); })->count();
        $warning = Alarma::where('codigo', 2)->orWhere(function($query) { $query->where('codigo', 5); })->count();

        return [$success, $errors, $warning];
    }

    public function getCodigoAlarma ()
    {
        return [
            'success_conexion' => Alarma::whereCodigo(1)->whereActivo(true)->count(),
            'errors_conexion'  => Alarma::whereCodigo(0)->whereActivo(true)->count(),
            'success_alarmas_equipos' => Alarma::whereCodigo(4)->count(),
            'errors_alarmas_equipos'  => Alarma::whereCodigo(3)->count(),
            'warning_alarmas_equipos' => Alarma::whereCodigo(5)->count(),
            'success_request' => Alarma::whereCodigo(7)->count(),
            'error_request'   => Alarma::whereCodigo(6)->count(),
        ];
    }

    public function getFavorito()
    {
        $dispositivos = Dispositivo::whereFavorito(true)->get();

        foreach($dispositivos as $dispositivo)
        {
            $success = Alarma::whereDispositivoId($dispositivo->id)->whereCodigo(4)->count();
            $errors  = Alarma::whereDispositivoId($dispositivo->id)->whereCodigo(3)->count();
            $warning = Alarma::whereDispositivoId($dispositivo->id)->whereCodigo(5)->count();
            $total = $success + $errors + $warning;

            $alarmas[] = [
                'nombre'  => $dispositivo->nombre,
                'id'      => $dispositivo->id,
                'success' => $success,
                'errors'  => $errors,
                'warning' => $warning,
                'total'   => $total,
            ];
        }

        return $alarmas;
    }

    public function getStatus()
    {
        $desconectados = Alarma::whereCodigo(0)->whereActivo(true)->count();
        $conectados    = Alarma::whereCodigo(1)->whereActivo(true)->count();

        return ['conectados' => $conectados, 'desconectados' => $desconectados];
    }

    public function getAlarmas($activo, $codigo)
    {
        if($codigo == 1)
        {
            return Alarma::where('activo', 'LIKE', '%'.$activo.'%')
                ->where('codigo', 1)
                ->orWhere(function($query) {
                    $query->where('codigo', 4);
                })
                ->where('updated_at', '>=', $this->date)
                ->latest()
                ->paginate(20);
        }

        if($codigo == 2) {
            return Alarma::where('activo', 'LIKE', '%'.$activo.'%')
                ->where('codigo', 2)
                ->orWhere(function($query) {
                    $query->where('codigo', 5);
                })
                ->where('updated_at', '>=', $this->date)
                ->latest()
                ->paginate(20);
        }

        if($codigo == 0) {
            return Alarma::where('activo', 'LIKE', '%'.$activo.'%')
                ->where('codigo', 0)
                ->orWhere(function($query) {
                    $query->where('codigo', 3);
                    $query->orWhere('codigo', 6);
                })
                ->where('updated_at', '>=', $this->date)
                ->latest()
                ->paginate(20);
        }

        return Alarma::where('activo', 'LIKE', '%'.$activo.'%')
            ->where('codigo', '<>', 7)
            ->where('updated_at', '>=', $this->date)
            ->latest()
            ->paginate(20);
    }

}
