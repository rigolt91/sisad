<?php

namespace App\Http\Livewire\Dispositivo\Component;

use Livewire\Component;
use App\Http\Controllers\GetDataGraficaController;
use Carbon\Carbon;

class Graficar extends Component
{
    protected $listeners = ['refreshDate' => 'refresh'];

    public $graficas;
    public $dispositivo;
    public $datas = [];
    public $date;
    public $codigo = '';
    public $sistema;
    public $reset = 0;

    public function mount()
    {
        if($this->sistema == 0)
        {
            $this->date = 360;
        }

        $GetDataGrafica = new GetDataGraficaController();

        $GetDataGrafica->setDatas($this->graficas, $this->dispositivo->id, $this->dispositivo->plantilla_id, $this->date);

        $this->datas = $GetDataGrafica->getDatas();
    }

    public function refresh($date){
        $this->date = $date;
    }

    public function render()
    {
        return view('livewire.dispositivo.component.graficar');
    }
}
