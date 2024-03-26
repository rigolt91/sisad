<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Breadcrumb extends Component
{
    public $links;

    public function render()
    {
        return view('livewire.breadcrumb')
            ->extends('layouts.app')
            ->section('breadcrumb');
    }
}
