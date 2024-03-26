<?php

namespace App\Http\Livewire\Usuario;

use Livewire\Component;
use App\Models\User;
use App\Http\Traits\Alert;

class Edit extends Component
{
    use Alert;

    public $user_id;
    public $name  = '';
    public $email = '';
    public $role  = '';
    public $password = '';
    public $password_confirmation = '';

    public $rules = [
        'name' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|max:50',
        'password_confirmation' => 'required|same:password|min:8|max:50',
        'role' => 'required'
    ];

    public function mount($id)
    {
        $user = User::find($id);

        $this->user_id = $id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = ($user->hasRole('administrador') ? 'administrador' : 'tecnico');
    }

    public function update()
    {
        $this->validate();

        $user = User::find($this->user_id);
        $user->assignRole($this->role);
        $user->name = $this->name;
        $user->email = $this->email;
        $user->password = bcrypt($this->password);
        $user->update();

        $this->alert('success', 'Usuario actualziado correctamente correctamente.');

        $this->resetCampos();
    }

    public function resetCampos()
    {
        $this->password = '';
        $this->password_confirmation = '';
    }

    public function render()
    {
        return view('livewire.usuario.edit')
            ->extends('layouts.app')
            ->section('content');
    }
}
