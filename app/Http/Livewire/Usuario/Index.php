<?php

namespace App\Http\Livewire\Usuario;

use Livewire\Component;
use App\Models\User;
use App\Http\Traits\Alert;

class Index extends Component
{
    use Alert;

    public function edit($id)
    {
        return redirect()->route('usuario.edit', $id);
    }

    public function destroy($id)
    {
        $user = User::find($id);

        if($user->name != 'Administrador')
        {
            $user->delete();

            $this->alert('success', 'El usuario se ha eliminado correctamente.');
        } else {
            $this->alert('danger', 'Este usuario no se puede eliminar.');
        }
    }

    public function render()
    {
        return view('livewire.usuario.index')
            ->with('users', User::all())
            ->extends('layouts.app')
            ->section('content');
    }
}
