<?php

namespace App\Http\Livewire\Alarmas;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Provincia;
use App\Models\Municipio;
use App\Models\Ubicacion;
use App\Models\Alarma;
use App\Models\Dispositivo as ModelDispositivo;

class Dispositivo extends Component
{
    use WithPagination;

    public $dispositivos;
    public $search;
    public $dispositivo_id;
    public $success;
    public $errores;
    public $codigo = '';
    public $activo = '';

    public function mount()
    {
        $this->dispositivos = ModelDispositivo::whereActivo(true)->get();
    }

    public function verEquipo($id)
    {
        $this->dispositivo_id = $id;

        $this->getAlarmaEquipo($id);
    }

    public function getAlarmaEquipo($id)
    {
        $dispositivo = ModelDispositivo::find($id);

        $alarmas = $dispositivo->plantilla->plantillaOid->where('tipo_oid', 1);

        $success = [];
        $errors  = [];

        foreach($alarmas as $alarma)
        {
            if($alarma->status_ok == $alarma->infoAlarma->first()->data)
            {
                $success[] = $alarma->identificador;
            }
        }
        foreach($alarmas as $alarma)
        {
            if($alarma->status_ok != $alarma->infoAlarma->first()->data)
            {
                $errors[] = $alarma->identificador;
            }
        }


        $this->success = $success;
        $this->errores = $errors;
    }

    public function getAlarmas()
    {
        if($this->codigo == 1)
        {
            return Alarma::where('activo', 'LIKE', '%'.$this->activo.'%')
                ->where('codigo', 1)
                ->orWhere(function($query) {
                    $query->where('codigo', 4);
                })
                ->whereDispositivoId($this->dispositivo_id)
                ->latest()
                ->paginate(20);
        }

        if($this->codigo == 2) {
            return Alarma::where('activo', 'LIKE', '%'.$this->activo.'%')
                ->where('codigo', 2)
                ->orWhere(function($query) {
                    $query->where('codigo', 5);
                })
                ->whereDispositivoId($this->dispositivo_id)
                ->latest()
                ->paginate(20);
        }

        if($this->codigo == 0) {
            return Alarma::where('activo', 'LIKE', '%'.$this->activo.'%')
                ->where('codigo', 0)
                ->orWhere(function($query) {
                    $query->where('codigo', 3);
                    $query->orWhere('codigo', 6);
                })
                ->whereDispositivoId($this->dispositivo_id)
                ->latest()
                ->paginate(20);
        }

        return Alarma::where('activo', 'LIKE', '%'.$this->activo.'%')
            ->where('codigo', '<>', 7)
            ->whereDispositivoId($this->dispositivo_id)
            ->latest()
            ->paginate(20);
    }

    public function render()
    {
        return view('livewire.alarmas.dispositivo')
            ->with('provincias', Provincia::all())
            ->with('municipios', Municipio::all())
            ->with('centros', Ubicacion::all())
            ->with('alarmas', $this->getAlarmas())
            ->extends('layouts.app')
            ->section('content');
    }
}
