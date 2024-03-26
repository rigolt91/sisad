<?php

namespace App\Http\Traits;

use App\Models\Plantilla;

trait PlantillaCreate
{
    public $add_plantilla = false;

    public function addPlantilla()
    {
        $this->add_plantilla    = true;
        $this->plantilla        = '';
    }

    public function storePlantilla()
    {
        $this->validate([
            'plantilla' => 'required|unique:plantillas,nombre'
        ]);

        $plantilla = Plantilla::create([ 'nombre' => $this->plantilla ]);

        $this->plantilla = $plantilla->id;

        $this->add_plantilla = false;
    }
}
