<div>
    @livewire('breadcrumb', ['links' => [
        ['title' => 'Dashboard', 'url' => 'home'],
        ['title' => 'Sistema', 'url' => ''],
        ['title' => 'Logs', 'url' => ''],
    ]])

    <div class="container-fluid">
        <div class="text-light fw-bold">
            <i class="fa fa-list"></i> Registro de logs del sistema

            <div class="float-end me-2">
                <select wire:model='paginas' class="form-select form-select-sm bg-dark text-light ms-2 border-0 rounded">
                    <option value="5"> &nbsp;&nbsp;5 logs por página</option>
                    <option value="10">10 logs por página</option>
                    <option value="15">15 logs por página</option>
                    <option value="20">20 logs por página</option>
                </select>
            </div>
        </div>

        <hr class="text-light">

        @livewire('app.sistema-status')

        <div class="card bg-dark text-light shadow mb-3">
            <div class="card-body">
                @if ($logs->count() > 0)
                    <table class="table table-sm table-dark table-hover shadow-sm">
                        <thead class="text-light">
                            <tr>
                                <th>No.</th>
                                <th>Fecha</th>
                                <th>Hora</th>
                                <th>Accion</th>
                                <th>Mensage</th>
                                <th>Usuario</th>
                                <th>Rol de Usuario</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($logs as $key => $log)
                                <tr>
                                    <td class="text-light">{{ ++$key }}</td>
                                    <td class="text-light">{{ $log->created_at->format('Y-m-d') }}</td>
                                    <td class="text-light">{{ $log->created_at->format('H:i:s') }}</td>
                                    <td class="@if ($log->actions == 'success') text-success @else text-danger @endif">{{ $log->actions }}</td>
                                    <td class="text-light">{{ $log->message }}</td>
                                    <td class="text-light">{{ $log->user->name }}</td>
                                    <td class="text-light">
                                        @if ($log->user->hasRole('tecnico'))
                                            Tecnico
                                        @else
                                            Administrador
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $logs->links('vendor.pagination.simple-bootstrap-5') }}
                @endif
            </div>
        </div>
    </div>
</div>
