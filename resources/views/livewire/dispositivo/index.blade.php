<div>
    @livewire('breadcrumb', ['links' => [
        ['title' => 'Dashboard', 'url' => 'home'],
        ['title' => 'Dispositivos', 'url' => 'dispositivos'],
        ['title' => 'Todas los dispositivos', 'url' => ''],
    ]])

    <div class="container-fluid">
        <div class="text-light fw-bold">
            <i class="fa fa-list"></i> {{ __('Todos los dispositivos') }}

            @include('livewire.dispositivo.opciones_search')
        </div>
        <hr class="text-light">

        @livewire('app.sistema-status')

        @include('livewire.alert')

        <div class="card bg-dark text-light shadow border-0">
            <div class="card-body">
                <table class="table table-sm table-dark table-hover">
                    <thead>
                        <th>Nro</th>
                        <th>Nombre</th>
                        <th>Ip Address</th>
                        <th>Descripción</th>
                        <th>Plantilla</th>
                        <th>Ubicacion</th>
                        <th>Activo</th>
                        <th>
                            <select wire:model='paginas' class="form-select form-select-sm bg-dark text-light me-2 border-0 rounded">
                                <option value="5"> &nbsp;&nbsp;5 por página</option>
                                <option value="10">10 por página</option>
                                <option value="15">15 por página</option>
                                <option value="20">20 por página</option>
                            </select>
                        </th>
                    </thead>
                    <tbody>
                        @foreach ($dispositivos as $key => $dispositivo)
                            @if (isset($dispositivo))
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $dispositivo->nombre }}</td>
                                    <td>{{ $dispositivo->ip_address }}</td>
                                    <td>{{ $dispositivo->descripcion }}</td>
                                    <td>{{ $dispositivo->plantilla->nombre }}</td>
                                    <td>
                                        {{ $dispositivo->provincia->nombre }},
                                        {{ $dispositivo->municipio->nombre }},
                                        {{ $dispositivo->ubicacion->nombre }}
                                    </td>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input p-2"  type="checkbox" role="switch" wire:click='activo({{ $dispositivo->id }})' value="{{ $dispositivo->activo }}" @if($dispositivo->activo) checked @endif @if(@Auth::user()->hasRole('tecnico')) disabled @endif>
                                        </div>
                                    </td>
                                    <td class="text-end">
                                        <button wire:click='show({{ $dispositivo->id }})' type="button" class="btn btn-sm btn-outline-info border-0">
                                            <i class="fa fa-eye fa-lg"></i>
                                        </button>
                                        @if(@Auth::user()->hasRole('administrador'))
                                        <button wire:click='edit({{ $dispositivo->id }})' type="button" class="btn btn-sm btn-outline-primary border-0">
                                            <i class="fa fa-edit fa-lg"></i>
                                        </button>
                                        <button data-bs-toggle="modal" data-bs-target="#destroy{{$dispositivo->id}}" class="btn btn-sm btn-outline-danger border-0">
                                            <i class="fa fa-trash fa-lg"></i>
                                        </button>

                                        <div class="modal fade" id="destroy{{$dispositivo->id}}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content bg-dark shadow">
                                                    <div class="modal-header bg-danger text-white fw-bold">
                                                        <h5 class="modal-title"><i class="fa fa-trash fa-lg me-3"></i> Eliminar Equipo</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form wire:submit.prevent='destroy({{ $dispositivo->id }})' method="POST">
                                                        <div class="modal-body text-white text-start">
                                                            Esta seguro que quiere eliminar este equipo?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                            <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Aceptar</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>

                {{ $dispositivos->links('pagination::simple-bootstrap-5') }}
            </div>
        </div>
    </div>
</div>
