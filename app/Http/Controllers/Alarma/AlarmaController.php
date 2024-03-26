<?php

namespace App\Http\Controllers\Alarma;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Alarma;
use App\Models\InfoEquipo;
use App\Models\Dispositivo;
use Carbon\Carbon;

class AlarmaController extends Controller
{
    public $infos;
    public $success;
    public $warnings;
    public $errors;
    public $date;


    /**Ontener la fecha para mostrar las alarmas según rango seleccionado */
    public function __construct($date)
    {
        if($date == 0)
        {
            $this->date = Carbon::now()->subMinutes(5);

        } elseif($date == 1) {

            $this->date = Carbon::now()->subHours(1);

        } elseif($date == 2) {

            $this->date = Carbon::now()->subMonth();

        }
    }

    /**Obtener las alarmas por categorías
     * Equipos conectados = 1
     * Equipos desconectados = 0
     * Equipos con alarmas de errores = 3
     * Equipos con alarmas de satisfactorio = 4
     * Equipos con alarmas de advertencias = 5
    */
    public function getCategoriaAlarmas()
    {
        $errors     = Alarma::whereActivo(1)->where('codigo', 0)->get();
        $success    = Alarma::whereActivo(1)->where('codigo', 1)->get();
        $alarma_errors  = Alarma::whereActivo(1)->where('codigo', 3)->where('updated_at', '>=', $this->date)->get();
        $alarma_success = Alarma::whereActivo(1)->where('codigo', 4)->where('updated_at', '>=', $this->date)->get();
        $alarma_warning = Alarma::whereActivo(1)->where('codigo', 5)->where('updated_at', '>=', $this->date)->get();


        return [
            'errors'    => $errors,
            'success'   => $success,
            'alarma_warning'  => $alarma_warning,
            'alarma_success'  => $alarma_success,
            'alarma_errors'   => $alarma_errors
        ];
    }

    /**Obtener alarmas según códigos
     * Equipos con alarmas de errores = 0, 3, 6
     * Equipos con alarmas de satisfactorio = 1, 4, 7
     * Equipos con alarmas de advertencias = 2, 5
    */
    public function getAlarmas($codigo, $activo = '')
    {
        if($codigo == 1)
        {
            return Alarma::where('activo', 'LIKE', '%'.$activo.'%')
                ->where('codigo', 1)
                ->orWhere(function($query) {
                    $query->where('codigo', 4);
                    $query->orWhere('codigo', 7);
                })
                ->where('updated_at', '>=', $this->date)
                ->latest()
                ->paginate(15);
        }

        if($codigo == 2) {
            return Alarma::where('activo', 'LIKE', '%'.$activo.'%')
                ->where('codigo', 2)
                ->orWhere(function($query) {
                    $query->where('codigo', 5);
                })
                ->where('updated_at', '>=', $this->date)
                ->latest()
                ->paginate(15);
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
                ->paginate(15);
        }

        return Alarma::where('activo', 'LIKE', '%'.$activo.'%')
            ->where('updated_at', '>=', $this->date)
            ->latest()
            ->paginate(15);
    }

    /**Obtener Equipos Favoritos y sus correspondientes alarmas */
    public function getFavoritos()
    {
        return Dispositivo::select('id', 'nombre', 'ip_address', 'plantilla_id')
            ->where('activo', true)
            ->where('favorito', true)
            ->paginate(6);
    }
}
