<?php

namespace App\Http\Traits;

use App\Models\Ubicacion;

trait UbicacionCreate
{
    public $add_ubicacion = false;

    public function addUbicacion()
    {
        $this->add_ubicacion    = true;
        $this->ubicacion        = '';
    }

    public function storeUbicacion()
    {
        $this->validate([
            'ubicacion' => 'required',
            'municipio' => 'required'
        ]);

        $ubicacion = Ubicacion::create([
            'nombre'        => $this->ubicacion,
            'municipio_id'  => $this->municipio
        ]);

        $this->ubicacion = $ubicacion->id;

        $this->add_ubicacion = false;
    }
}
