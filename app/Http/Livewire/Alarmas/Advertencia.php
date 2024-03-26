<?php

namespace App\Http\Livewire\Alarmas;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Dispositivo;
use App\Models\Provincia;
use App\Models\Municipio;
use App\Models\Ubicacion;
use App\Models\Alarma;

class Advertencia extends Component
{
    use WithPagination;

    public $dispositivo_id = '';
    public $provincia = '';
    public $municipio = '';
    public $centro = '';
    public $activo = '';

    public function getAlarmas()
    {
        return Alarma::where('dispositivo_id', 'LIKE', '%'.$this->dispositivo_id.'%')
            ->where('codigo', 2)
            ->orWhere(function($query) {
                $query->where('dispositivo_id', 'LIKE', '%'.$this->dispositivo_id.'%');
                $query->where('codigo', 5);
            })
            ->latest()->paginate(20);
    }


    public function render()
    {
        return view('livewire.alarmas.advertencia')
            ->with('dispositivos', Dispositivo::whereActivo(true)->where('provincia_id', 'LIKE', '%'.$this->provincia.'%')->where('municipio_id', 'LIKE', '%'.$this->municipio.'%')->where('ubicacion_id', 'LIKE', '%'.$this->centro.'%')->get())
            ->with('provincias', Provincia::all())
            ->with('municipios', Municipio::where('provincia_id', 'LIKE', '%'.$this->provincia.'%')->get())
            ->with('centros', Ubicacion::where('municipio_id', 'LIKE', '%'.$this->municipio.'%')->get())
            ->with('alarmas', $this->getAlarmas())
            ->extends('layouts.app')
            ->section('content');
    }
}
