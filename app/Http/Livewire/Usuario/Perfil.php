<?php

namespace App\Http\Livewire\Usuario;

use Livewire\Component;
use App\Models\User;
use App\Http\Traits\Alert;

class Perfil extends Component
{
    use Alert;

    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    public $role;
    public $user;

    public $rules = [
        'password' => 'required|min:8|max:50',
        'password_confirmation' => 'required|same:password|min:8|max:50',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function mount($id)
    {
        $this->user = User::find($id);

        $this->name  = $this->user->name;
        $this->email = $this->user->email;
        $this->role  = ($this->user->hasRole('administrador') ? 'Administrador' : 'Tecnico');
    }

    public function update()
    {
        $this->validate();

        $this->user->password = bcrypt($this->password);
        $this->user->update();

        $this->alert('success', 'La constraseña se actualizo correctamente.');
    }

    public function render()
    {
        return view('livewire.usuario.perfil')
            ->extends('layouts.app')
            ->section('content');
    }
}
