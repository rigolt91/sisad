<?php

namespace App\Http\Livewire\Notas;

use Livewire\Component;
use App\Models\Nota;

class Index extends Component
{
    public function setVista(Nota $nota)
    {
        $nota->vista = !$nota->vista;
        $nota->update();
    }

    public function destroy(Nota $nota)
    {
        try {
            $nota->delete();

            toastr()->success('Anotación eliminada correctamente.');
        } catch (\Throwable $th) {
            toastr()->success('Error al eliminar la anotación.');
        }

    }

    public function render()
    {
        return view('livewire.notas.index', [
            'notas' => Nota::latest()->get()
        ])
        ->extends('layouts.app')
        ->section('content');
    }
}
