<?php

namespace App\Http\Livewire\Home;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Sistema;

class Index extends Component
{
    use WithPagination;

    public $date = '';
    public $rango = '';
    public $sistema;

    public function mount()
    {
        $this->date = 0;

        $sistema = Sistema::latest()->first();

        if($sistema)
        {
            if($sistema->status == true)
            {
                $this->sistema = true;
            } else {
                $this->sistema = false;
            }
        }
    }

    public function setDate($date)
    {
        $this->date = $date;

        $this->emit('refreshDate', $this->date);
    }

    public function render()
    {
        return view('livewire.home.index')
            ->extends('layouts.app')
            ->section('content');
    }
}
