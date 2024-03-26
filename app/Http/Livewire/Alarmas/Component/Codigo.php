<?php

namespace App\Http\Livewire\Alarmas\Component;

use Livewire\Component;
use App\Http\Controllers\Alarma\GetAllAlarmaController;

class Codigo extends Component
{
    public function getCodigoAlarma()
    {
        $getAllAlarma = new GetAllAlarmaController();
        $getAllAlarma->setDate();

        return $getAllAlarma->getCodigoAlarma();
    }

    public function render()
    {
        return view('livewire.alarmas.component.codigo')
            ->with('codigo_alarma', $this->getCodigoAlarma());
    }
}
