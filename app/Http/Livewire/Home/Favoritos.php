<?php

namespace App\Http\Livewire\Home;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Dispositivo;

class Favoritos extends Component
{
    use WithPagination;

    protected $listeners = ['refreshDate' => 'refresh'];

    public $date;
    public $sistema;

    public function refresh($date){
        $this->date = $date;
    }

    public function render()
    {
        return view('livewire.home.favoritos', [
            'dispositivos' => Dispositivo::where('activo', 1)
                ->where('favorito', 1)
                ->paginate(5)
        ]);
    }
}
