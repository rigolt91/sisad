<?php

namespace App\Http\Livewire\Dispositivo\Component;

use Livewire\Component;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Controllers\ResetComandoDispositivo;
use App\Models\Sistema;

class ComandoSistema extends Component
{
    public $comandos;
    public $dispositivo;
    public $button_status = '';
    public $status;

    protected $listeners = ['reset-comando' => '$refresh'];

    public function mount()
    {
        $status = Sistema::first();

        if(empty($status) || $status->false)
        {

            $this->status = 'disabled';

        } elseif($status->true) {
            $this->status = '';
        }
    }

    public function resetComando($comando)
    {
        $ResetComandoDispositivo = new ResetComandoDispositivo();
        $result = $ResetComandoDispositivo->resetComando($this->dispositivo, $comando['oid']);

        $this->button_status = 'disabled';

        if($result['status'])
        {
            toastr()->success($result['message']);

            $this->button_status = '';

            $this->emit('reset-comando');
        } else {
            toastr()->error($result['message']);
        }
    }

    public function render()
    {
        return view('livewire.dispositivo.component.comando-sistema');
    }
}
