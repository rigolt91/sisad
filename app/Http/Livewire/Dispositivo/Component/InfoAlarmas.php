<?php

namespace App\Http\Livewire\Dispositivo\Component;

use Livewire\Component;

class InfoAlarmas extends Component
{
    public $alarmas;

    public function render()
    {
        return view('livewire.dispositivo.component.info-alarmas');
    }
}
