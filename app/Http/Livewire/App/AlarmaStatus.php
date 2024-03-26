<?php

namespace App\Http\Livewire\App;

use Livewire\Component;
use App\Models\Alarma;
use Carbon\Carbon;

class AlarmaStatus extends Component
{
    public $errores  = 0;
    public $success = 0;
    public $warning = 0;

    public function render()
    {
        $date = Carbon::now()->subMinutes(5);

        $this->errores  = Alarma::whereActivo(1)->where('codigo', 3)->where('updated_at', '>=', $date)->count();
        $this->success = Alarma::whereActivo(1)->where('codigo', 4)->where('updated_at', '>=', $date)->count();
        $this->warning = Alarma::whereActivo(1)->where('codigo', 5)->where('updated_at', '>=', $date)->count();

        return view('livewire.app.alarma-status');
    }
}
