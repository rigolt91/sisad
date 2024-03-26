<?php

namespace App\Http\Livewire\Dispositivo\Component;

use Livewire\Component;

class InfoSistema extends Component
{
    public $info_sistema;

    public function render()
    {
        return view('livewire.dispositivo.component.info-sistema');
    }
}
