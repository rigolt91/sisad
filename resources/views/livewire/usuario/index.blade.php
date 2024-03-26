<div>
    @livewire('breadcrumb', ['links' => [
        ['title' => 'Dashboard', 'url' => 'home'],
        ['title' => 'Usuario', 'url' => ''],
        ['title' => 'Listado de usuario', 'url' => ''],
    ]])

    <div class="container-fluid">
        <div class="text-light fw-bold">
            <i class="fa fa-list"></i> Listado de usuarios

            <a href="{{ route('usuario.create') }}" class="btn btn-sm btn-primary float-end"><i class="fa fa-plus"></i></a>
        </div>

        <hr class="text-light">

        @livewire('app.sistema-status')

        @include('livewire.alert')

        <div class="row">
            <div class="col">
                <div class="card bg-dark text-light shadow">
                    <div class="card-body">
                        <table class="table table-hover text-light">
                            <thead>
                                <tr>
                                    <th>Nro</th>
                                    <th>Nombre</th>
                                    <th>Correo electrónico</th>
                                    <th>Rol de usuario</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $key => $user)
                                <tr style="cursor: pointer">
                                    <td class="text-light">{{ ++$key }}</td>
                                    <td class="text-light">{{ $user->name }}</td>
                                    <td class="text-light">{{ $user->email }}</td>
                                    <td class="text-light">
                                        @if ($user->hasRole('administrador'))
                                            Administrador
                                        @else
                                            Técnico
                                        @endif
                                    </td>
                                    <td>
                                        <div class="float-end">
                                            <button wire:click='edit({{ $user->id }})' type="button" class="btn btn-sm btn-outline-primary border-0" @if(Auth::user()->id==$user->id) disabled @endif>
                                                <i class="fa fa-edit fa-lg"></i>
                                            </button>

                                            <button data-bs-toggle="modal" data-bs-target="#destroy{{$user->id}}" class="btn btn-sm btn-outline-danger border-0" @if($user->hasRole('administrador')) disabled @endif>
                                                <i class="fa fa-trash fa-lg"></i>
                                            </button>

                                            <div class="modal fade" id="destroy{{$user->id}}" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content bg-dark shadow">
                                                        <div class="modal-header bg-danger text-white fw-bold">
                                                            <h5 class="modal-title"><i class="fa fa-trash fa-lg me-3"></i> Eliminar Usuario</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form wire:submit.prevent='destroy({{ $user->id }})' method="POST">
                                                            <div class="modal-body text-white text-start">
                                                                Esta seguro que quiere eliminar este usuario?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                                <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Aceptar</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
