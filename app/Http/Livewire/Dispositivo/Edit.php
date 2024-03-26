<?php

namespace App\Http\Livewire\Dispositivo;

use Livewire\Component;
use App\Models\Dispositivo;
use App\Http\Traits\Alert;
use App\Http\Traits\PlantillaCreate;
use App\Http\Traits\ProvinciaCreate;
use App\Http\Traits\MunicipioCreate;
use App\Http\Traits\UbicacionCreate;
use App\Models\Provincia;
use App\Models\Municipio;
use App\Models\Ubicacion;
use App\Models\Plantilla;

class Edit extends Component
{
    use Alert, PlantillaCreate, ProvinciaCreate, MunicipioCreate, UbicacionCreate;

    public $dispositivo_id;
    public $nombre;
    public $ip_address;
    public $comunidad;
    public $descripcion;
    public $observacion;
    public $plantilla = '';
    public $provincia = '';
    public $municipio = '';
    public $ubicacion = '';
    public $imagen;
    public $version_snmp = 2;
    public $favorito;

    public $rules = [
        'nombre'        => 'required',
        'ip_address'    => 'required|ipv4',
        'comunidad'     => 'required',
        'descripcion'   => 'required',
        'observacion'   => 'nullable',
        'plantilla'     => 'required',
        'provincia'     => 'required',
        'municipio'     => 'required',
        'ubicacion'     => 'required',
        'imagen'        => 'nullable|mimes:png,jpg',
        'version_snmp'  => 'required',
        'favorito'      => 'nullable'
    ];

    public function mount($id)
    {
        $dispositivo = Dispositivo::find($id);

        $this->dispositivo_id = $dispositivo->id;
        $this->nombre       = $dispositivo->nombre;
        $this->ip_address   = $dispositivo->ip_address;
        $this->comunidad    = $dispositivo->comunidad;
        $this->descripcion  = $dispositivo->descripcion;
        $this->observacion  = $dispositivo->observacion;
        $this->plantilla    = $dispositivo->plantilla_id;
        $this->provincia    = $dispositivo->provincia_id;
        $this->municipio    = $dispositivo->municipio_id;
        $this->ubicacion    = $dispositivo->ubicacion_id;
        $this->imagen       = $dispositivo->imagen;
        $this->version_snmp = $dispositivo->version_snmp;
        $this->favorito     = $dispositivo->favorito;
    }

    public function index()
    {
        redirect()->route('dispositivos');
    }

    public function update()
    {
        $dispositivo = Dispositivo::find($this->dispositivo_id);

        $dispositivo->update([
            'nombre'        => $this->nombre,
            'ip_address'    => $this->ip_address,
            'comunidad'     => $this->comunidad,
            'descripcion'   => $this->descripcion,
            'observacion'   => $this->observacion,
            'plantilla_id'  => $this->plantilla,
            'provincia_id'  => $this->provincia,
            'municipio_id'  => $this->municipio,
            'ubicacion_id'  => $this->ubicacion,
            'imagen'        => $this->imagen,
            'version_snmp'  => $this->version_snmp,
            'favorito'      => $this->favorito
        ]);

        $this->alert('success', 'El dispositivo fue actualizado correctamente.', $dispositivo->nombre);

        redirect()->route('dispositivos');
    }

    public function cancelar()
    {
        return redirect()->route('dispositivos');
    }

    public function render()
    {
        return view('livewire.dispositivo.edit')
            ->with('provincias', Provincia::all())
            ->with('municipios', Municipio::where('provincia_id', 'like', '%'.$this->provincia.'%')->get())
            ->with('ubicaciones', Ubicacion::where('municipio_id', 'like', '%'.$this->municipio.'%')->get())
            ->with('plantillas', Plantilla::all())
            ->extends('layouts.app')
            ->section('content');
    }
}
