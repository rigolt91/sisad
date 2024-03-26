<?php

namespace App\Http\Livewire\Dispositivo;

use Livewire\Component;
use Livewire\WithPagination;
use App\Http\Traits\Alert;
use App\Models\Dispositivo;
use App\Models\Provincia;
use App\Models\Municipio;
use App\Models\Ubicacion;

class Favorito extends Component
{
    use WithPagination, Alert;

    public $search  = '';
    public $paginas = 15;
    public $provincia = '';
    public $municipio = '';
    public $centro = '';

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
        return view('livewire.dispositivo.favorito')
            ->with('dispositivos', Dispositivo::where('nombre', 'like', '%'.$this->search.'%')
                ->where('provincia_id', 'like', '%'.$this->provincia.'%')
                ->where('municipio_id', 'like', '%'.$this->municipio.'%')
                ->where('ubicacion_id', 'like', '%'.$this->centro.'%')
                ->where('favorito', 1)
                ->paginate($this->paginas)
            )
            ->with('provincias', Provincia::all())
            ->with('municipios', Municipio::where('provincia_id', 'like', '%'.$this->provincia.'%')->get())
            ->with('centros', Ubicacion::where('municipio_id', 'like', '%'.$this->municipio.'%')->get())
            ->extends('layouts.app')
            ->section('content');
    }
}
