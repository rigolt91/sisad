<?php

namespace App\Http\Livewire\Plantilla;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Plantilla;
use App\Models\PlantillaOid;
use App\Models\OidAlarmaComando;
use App\Http\Traits\Alert;

class PlantillaOidComponent extends Component
{
    use WithPagination;
    use Alert;

    public $view    = 'index';
    public $search  = '';
    public $plantilla_id;
    public $nombre;
    public $identificador;
    public $tipo_oid;
    public $status_ok = '';
    public $oid;
    public $oid_id;
    public $comando;
    public $paginas = 10;

    public $rules = [
        'nombre'        => 'required',
        'identificador' => 'required',
        'tipo_oid'      => 'required',
        'oid'           => 'required|regex:/^[0-9,.]+$/|min:10',
    ];

    public function mount($id = null)
    {
        if($id)
        {
            $plantilla          = Plantilla::findOrFail($id);
            $this->plantilla_id = $plantilla->id;
            $this->nombre       = $plantilla->nombre;
        }
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function create()
    {
        $this->default();

        $this->view = 'create';
    }

    public function store()
    {
        $this->validate();

        if($this->tipo_oid == 1) { $this->validate([ 'status_ok' => 'required' ]); }

        if($this->tipo_oid == 5) { $this->validate([ 'comando' => 'required|unique:oid_alarma_comandos,comando_id' ]); }

        $plantilla_oid = PlantillaOid::create([
            'plantilla_id'  => $this->plantilla_id,
            'identificador' => $this->identificador,
            'tipo_oid'      => $this->tipo_oid,
            'status_ok'     => $this->status_ok,
            'oid'           => $this->oid,
        ]);

        if($this->tipo_oid == 5)
        {
            OidAlarmaComando::create([
                'plantilla_oid_id' => $plantilla_oid->id,
                'comando_id' => $this->comando
            ]);
        }

        $this->alert('success', 'Oid creado correctamente.', $this->identificador);

        $this->default();
        $this->view = 'index';
    }

    public function edit($id)
    {
        $plantilla_oid = PlantillaOid::find($id);
        $this->oid_id        = $plantilla_oid->id;
        $this->identificador = $plantilla_oid->identificador;
        $this->tipo_oid      = $plantilla_oid->tipo_oid;
        $this->status_ok     = $plantilla_oid->status_ok;
        $this->oid           = $plantilla_oid->oid;

        if($plantilla_oid->tipo_oid == 5)
        {
            $this->comando = $plantilla_oid->oidAlarmaComando->comando_id;
        }

        $this->view = 'edit';
    }

    public function update($id)
    {
        $this->validate();

        if($this->tipo_oid == 1) { $this->validate([ 'status_ok' => 'required' ]); }

        $plantilla_oid = PlantillaOid::find($id);
        $plantilla_oid->update([
            'plantilla_id'  => $this->plantilla_id,
            'identificador' => $this->identificador,
            'tipo_oid'      => $this->tipo_oid,
            'status_ok'     => $this->status_ok,
            'oid'           => $this->oid,
        ]);

        if($this->tipo_oid == 5)
        {
            $oid_alarma_comando = OidAlarmaComando::where('plantilla_oid_id', $plantilla_oid->id);

            if($oid_alarma_comando->get()->count() > 0)
            {
                $this->validate([ 'comando' => 'required' ]);

                $count = OidAlarmaComando::where('comando_id', $this->comando)
                    ->where('plantilla_oid_id', '<>', $plantilla_oid->id)
                    ->get()
                    ->count();

                if($count == 0)
                {
                    $oid_alarma_comando->update([
                        'plantilla_oid_id'  => $plantilla_oid->id,
                        'comando_id'        => $this->comando
                    ]);
                } else {
                    $this->alert('danger', 'El comando seleccionado se encuentra en uso.', 'Error');
                    return;
                }
            } else {
                $this->validate([
                    'comando' => 'required|unique:oid_alarma_comandos,comando_id'
                ]);

                OidAlarmaComando::create([
                    'plantilla_oid_id' => $plantilla_oid->id,
                    'comando_id' => $this->comando
                ]);
            }

        } else {
            $oid_alarma_comando = OidAlarmaComando::where('plantilla_oid_id', $plantilla_oid->id);
            $oid_alarma_comando->delete();
        }

        $this->alert('success', 'Oid actualziado correctamente.', $this->identificador);

        $this->default();
        $this->view = 'index';
    }

    public function destroy($id)
    {
        $plantilla_oid = PlantillaOid::find($id);

        $this->alert('success', 'Oid eliminado correctamente.', $plantilla_oid->identificador);

        $plantilla_oid->delete();
    }

    public function cancelar()
    {
        $this->default();
        $this->view = 'index';
    }

    public function default()
    {
        $this->identificador = '';
        $this->tipo_oid = '';
        $this->oid = '';
        $this->status_ok = '';
        $this->comando = '';
    }

    public function render()
    {
        return view('livewire.plantilla.plantilla_oid.plantilla-oid-component')
            ->with('oids', PlantillaOid::where('identificador', 'like', '%'.$this->search.'%')->where('plantilla_id', $this->plantilla_id)->paginate($this->paginas))
            ->with('comandos', PlantillaOid::where('tipo_oid', 4)->where('plantilla_id', $this->plantilla_id)->get())
            ->extends('layouts.app')
            ->section('content');
    }
}
