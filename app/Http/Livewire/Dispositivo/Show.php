<?php

namespace App\Http\Livewire\Dispositivo;

use Livewire\Component;

use FreeDSx\Snmp\Requests;
use FreeDSx\Snmp\SnmpClient;
use FreeDSx\Snmp\Exception\SnmpRequestException;
use App\Models\Dispositivo;
use App\Models\Sistema;

class Show extends Component
{
    public $alarmas;
    public $infos;
    public $graficas;
    public $comandos;
    public $dispositivo;
    public $condicion;
    public $date = '';
    public $rango = '';
    public $sistema = 0;

    public function mount($id)
    {
        $this->dispositivo = Dispositivo::findOrFail($id);

        $this->alarmas      = $this->dispositivo->plantilla->plantillaOid->where('tipo_oid', 1);
        $this->info_sistema = $this->dispositivo->plantilla->plantillaOid->where('tipo_oid', 2);
        $this->graficas     = $this->dispositivo->plantilla->plantillaOid->where('tipo_oid', 3);
        $this->comandos     = $this->dispositivo->plantilla->plantillaOid->where('tipo_oid', 5);

        $this->date = 0;

        $sistema = Sistema::latest()->first();

        if(!is_null($sistema))
        {
            $this->sistema = $sistema->status;
        }
    }

    public function setCarbon()
    {
        $this->emit('refreshDate', $this->date);
    }

    public function render()
    {
        return view('livewire.dispositivo.show')
            ->with('total_comandos', $this->comandos->count())
            ->extends('layouts.app')
            ->section('content');
    }
}
