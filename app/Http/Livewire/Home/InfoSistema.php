<?php

namespace App\Http\Livewire\Home;

use Livewire\Component;
use App\Models\Sistema;
use App\Models\Dispositivo;
use App\Models\Plantilla;
use App\Models\PlantillaOid;

class InfoSistema extends Component
{
    public function getStatusSistema()
    {
        $sistema = Sistema::latest()->first();

        if(is_null($sistema))
        {
            $status = 0;
        }else{
            $status = $sistema->status;
        }

        return $status;
    }

    public function render()
    {
        return view('livewire.home.info-sistema')
            ->with('status_sistema', $this->getStatusSistema())
            ->with('total_equipos', Dispositivo::count())
            ->with('total_plantillas', Plantilla::count())
            ->with('total_oids', PlantillaOid::count())
            ->with('favoritos', Dispositivo::whereFavorito(true)->whereActivo(true)->count());
    }
}
