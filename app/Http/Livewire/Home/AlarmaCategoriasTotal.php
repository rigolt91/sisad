<?php

namespace App\Http\Livewire\Home;

use Livewire\Component;
use App\Http\Controllers\Alarma\AlarmaController;
use App\Models\Nota;

class AlarmaCategoriasTotal extends Component
{
    public $date = null;
    public $status = 0;
    public $sistema;

    public function mount($date = null)
    {
        $this->date = $date;
    }

    public function render()
    {
        $AlarmaController = new AlarmaController($this->date);

        return view('livewire.home.alarma-categorias-total', [
            'alarmas' => $AlarmaController->getCategoriaAlarmas(),
            'notas' => Nota::where('vista', false)->count()
        ]);
    }
}
