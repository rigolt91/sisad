<?php

namespace App\Http\Livewire\Plantilla;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Plantilla;
use App\Http\Traits\Alert;

class PlantillaComponent extends Component
{
    use WithPagination;
    use Alert;

    public $view;
    public $nombre;
    public $plantilla_id;
    public $search  = '';
    public $paginas = 15;

    public $rules = [ 'nombre' => 'required|unique:plantillas,nombre' ];

    public function mount($view = 'index')
    {
        if($view <> 'index' && $view <> 'edit' && $view <> 'show' && $view <> 'create')
        {
            redirect()->to('errors.404');
        }else{
            $this->view = $view;
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

    public function show($id)
    {
        redirect()->route('plantillas.show', ['id' => $id]);
    }

    public function create()
    {
        $this->default();

        $this->view = 'create';
    }

    public function store()
    {
        $this->validate();

        Plantilla::create([ 'nombre' => $this->nombre ]);

        $this->alert('success', 'Plantilla creada correctamente.', $this->nombre);

        $this->default();
        $this->view = 'index';
    }

    public function edit($id)
    {
        $plantilla          = Plantilla::find($id);
        $this->plantilla_id = $plantilla->id;
        $this->nombre       = $plantilla->nombre;

        $this->view = 'edit';
    }

    public function update()
    {
        $this->validate([ 'nombre' => 'required' ]);

        $plantilla = Plantilla::find($this->plantilla_id);
        $plantilla->update([ 'nombre' => $this->nombre ]);

        $this->alert('success', 'Plantilla actualziada correctamente.', $this->nombre);

        $this->default();
        $this->view = 'index';
    }

    public function destroy($id)
    {
        $plantilla = Plantilla::find($id);

        $this->alert('success', 'Plantilla creada correctamente.', $plantilla->nombre);

        $plantilla->delete();
    }

    public function cancelar()
    {
        $this->default();
        $this->view = 'index';
    }

    public function default()
    {
        $this->nombre = '';
    }

    public function render()
    {
        return view('livewire.plantilla.plantilla-component')
            ->with('plantillas', Plantilla::where('nombre', 'like', '%'.$this->search.'%')->orderBy('id', 'desc')->paginate($this->paginas))
            ->extends('layouts.app')
            ->section('content');
    }
}
