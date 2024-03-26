<?php

namespace App\Http\Livewire\Notas;

use Illuminate\Http\Request;
use Livewire\Component;
use App\Models\Nota;

class Create extends Component
{
    public function save(Request $request)
    {
        try {
            Nota::create([
                'titulo' => $request->titulo,
                'texto' => $request->texto
            ]);

            toastr()->success('La anotación ('.$request->titulo.') fue guardada correctamente.');
        } catch (\Throwable $th) {
            toastr()->success('Imposible guardar la anotación ('.$request->titulo.').');
        }

        return redirect()->back()->withInput();
    }

    public function render()
    {
        return view('livewire.notas.create');
    }
}
