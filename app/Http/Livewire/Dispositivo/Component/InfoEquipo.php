<?php

namespace App\Http\Livewire\Dispositivo\Component;

use Livewire\Component;

class InfoEquipo extends Component
{
    public $dispositivo;

    public function render()
    {
        return view('livewire.dispositivo.component.info-equipo');
    }
}
