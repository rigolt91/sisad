<?php

namespace App\Http\Livewire\App;

use Livewire\Component;
use App\Models\Sistema;

class SistemaStatus extends Component
{
    public $status = false;

    public function getStatusSistema()
    {
        try {
            $task = exec('SCHTASKS /TN Sisad');
            $bd = Sistema::latest()->first();

            $status = ($bd && $bd->status) || $task ? true : false;

            if($status)
            {
                $this->status = true;
            }else{
                $this->status = false;
            }

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function render()
    {
        $this->getStatusSistema();

        return view('livewire.app.sistema-status')
            ->with('sistema', Sistema::latest()->first())
        ;
    }
}