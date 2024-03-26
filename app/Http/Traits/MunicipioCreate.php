<?php

namespace App\Http\Traits;

use App\Models\Municipio;

trait MunicipioCreate
{
    public $add_municipio = false;

    public function addMunicipio()
    {
        $this->add_municipio    = true;
        $this->municipio        = '';
    }

    public function storeMunicipio()
    {
        $this->validate([
            'municipio' => 'required',
            'provincia' => 'required'
        ]);

        $municipio = Municipio::create([
            'nombre'        => $this->municipio,
            'provincia_id'  => $this->provincia
        ]);

        $this->municipio = $municipio->id;

        $this->add_municipio = false;
    }
}
