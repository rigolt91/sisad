<?php

namespace App\Http\Livewire\Dispositivo;

use Livewire\Component;
use Livewire\WithPagination;
use App\Http\Traits\Alert;
use App\Models\Dispositivo;
use App\Models\Provincia;
use App\Models\Municipio;
use App\Models\Ubicacion;
use App\Models\Plantilla;

class Categoria extends Component
{
    use WithPagination, Alert;

    public $search  = '';
    public $paginas = 15;
    public $provincia = '';
    public $municipio = '';
    public $centro = '';
    public $categoria = '';
    public $plantilla_id;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function create()
    {
        redirect()->route('dispositivos.create');
    }

    public function edit($id)
    {
        redirect()->route('dispositivos.edit', $id);
    }

    public function show($id)
    {
        redirect()->route('dispositivos.show', $id);
    }

    public function destroy($id)
    {
        $dispositivo = Dispositivo::find($id);

        $this->alert('success', 'El dispositivo fue eliminado correctamente.', $dispositivo->nombre);

        $dispositivo->delete();
    }

    public function render()
    {
        $Plantillas = Plantilla::all();

        foreach($Plantillas as $plantilla)
        {
            $plantillas[] = [
                [
                    'nombre' => $plantilla->nombre
                ],
                [
                    'dispositivos' => Dispositivo::where('plantilla_id', $plantilla->id)
                        ->where('nombre', 'like', '%'.$this->search.'%')
                        ->where('provincia_id', 'like', '%'.$this->provincia.'%')
                        ->where('municipio_id', 'like', '%'.$this->municipio.'%')
                        ->where('ubicacion_id', 'like', '%'.$this->centro.'%')
                        ->orderBy('ubicacion_id', 'asc')
                        ->get()
                ]
            ] ;
        }

        return view('livewire.dispositivo.categoria')
            ->with('plantillas', $plantillas)
            ->with('provincias', Provincia::all())
            ->with('municipios', Municipio::all())
            ->with('centros', Ubicacion::all())
            ->extends('layouts.app')
            ->section('content');
    }
}
