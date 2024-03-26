<?php

namespace App\Http\Livewire\Home;

use Livewire\Component;
use Livewire\WithPagination;
use App\Http\Controllers\Alarma\AlarmaController;

class Alarmas extends Component
{
    use WithPagination;

    protected $listeners = ['refreshDate' => 'refresh'];

    public $date;
    public $codigo = '';
    public $sistema;

    public function setCodigo($codigo = '')
    {
        $this->codigo = $codigo;
    }

    public function refresh($date){
        $this->date = $date;
    }

    public function render()
    {


        $AlarmaController = new AlarmaController($this->date);

        if($this->sistema == true)
        {
            $activo = true;
        } else {
            $activo = '';
        }

        return view('livewire.home.alarmas', [
            'alarmas' => $AlarmaController->getAlarmas($this->codigo, $activo)
        ]);
    }
}
