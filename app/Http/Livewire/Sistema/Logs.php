<?php

namespace App\Http\Livewire\Sistema;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\LogsSistema;

class Logs extends Component
{
    use WithPagination;

    public $paginas = 15;

    public function render()
    {
        return view('livewire.sistema.logs')
            ->with('logs', LogsSistema::latest()->paginate($this->paginas))
            ->extends('layouts.app')
            ->section('content');
    }
}
