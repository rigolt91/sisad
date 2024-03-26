<?php

namespace App\Http\Livewire\Home;

use Livewire\Component;

use App\Models\Plantilla;

class DispositivoPlantilla extends Component
{
    public $plantillas = [];
    public $plantilla_equipos = [];
    public $sistema;

    public function getPlantillas()
    {
        $plantillas = Plantilla::all();

        foreach($plantillas as $plantilla)
        {
            $this->plantillas[] = $plantilla->nombre.' ('.$plantilla->dispositivo->count().')';
            $this->plantilla_equipos[] = $plantilla->dispositivo->count();
        }
    }

    public function render()
    {
        $this->getPlantillas();

        return view('livewire.home.dispositivo-plantilla');
    }
}
