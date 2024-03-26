<?php

namespace App\Http\Livewire\Usuario;

use Livewire\Component;
use App\Models\User;
use App\Http\Traits\Alert;

class Create extends Component
{
    use Alert;

    public $name  = '';
    public $email = '';
    public $role  = '';
    public $password = '';
    public $password_confirmation = '';

    public $rules = [
        'name' => 'required|unique:users,name',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:8|max:50',
        'password_confirmation' => 'required|same:password|min:8|max:50',
        'role' => 'required'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function update()
    {
        $this->validate();

        $user = new User();
        $user->name = $this->name;
        $user->email = $this->email;
        $user->password = bcrypt($this->password);
        $user->save();

        $user->assignRole($this->role);

        $this->alert('success', 'Usuario creado correctamente correctamente.');

        $this->resetCampos();
    }

    public function resetCampos()
    {
        $this->name = '';
        $this->email = '';
        $this->role = '';
        $this->password = '';
        $this->password_confirmation = '';
    }

    public function render()
    {
        return view('livewire.usuario.create')
            ->extends('layouts.app')
            ->section('content');
    }
}
