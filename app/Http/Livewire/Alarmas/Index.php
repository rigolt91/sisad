<?php

namespace App\Http\Livewire\Alarmas;

use Livewire\Component;
use App\Models\Provincia;
use App\Models\Municipio;
use App\Models\Ubicacion;
use App\Models\Dispositivo;
use App\Models\Alarma;
use App\Http\Controllers\Alarma\GetAllAlarmaController;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search  = '';
    public $provincia = '';
    public $municipio = '';
    public $centro = '';
    public $errors = 0;
    public $success = 0;
    public $activo = '';
    public $codigo = '';

    public function getFavoritos()
    {
        $getAllAlarma = new GetAllAlarmaController();
        $getAllAlarma->setDate();

        return $getAllAlarma->getFavorito();
    }

    public function getAllAlarmas()
    {
        $getAllAlarma = new GetAllAlarmaController();
        $getAllAlarma->setDate();

        return $getAllAlarma->getAlarmas($this->activo, $this->codigo);
    }

    public function render()
    {
        return view('livewire.alarmas.index')
            ->with('provincias', Provincia::all())
            ->with('municipios', Municipio::all())
            ->with('centros', Ubicacion::all())
            ->with('favoritos', $this->getFavoritos())
            ->with('alarmas', $this->getAllAlarmas())
            ->extends('layouts.app')
            ->section('content');
    }
}
