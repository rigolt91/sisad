<?php

namespace App\Http\Traits;

use App\Models\Provincia;

trait ProvinciaCreate
{
    public $add_provincia = false;

    public function addProvincia()
    {
        $this->add_provincia    = true;
        $this->provincia        = '';
    }

    public function storeProvincia()
    {
        $this->validate([
            'provincia' => 'required|unique:provincias,nombre'
        ]);

        $provincia = Provincia::create([ 'nombre' => $this->provincia ]);

        $this->provincia = $provincia->id;

        $this->add_provincia = false;
    }
}
