<div wire:poll.5000ms>
    @livewire('breadcrumb', ['links' => [
        ['title' => 'Dashboard', 'url' => 'home'],
        ['title' => 'Alarmas', 'url' => 'alarmas'],
        ['title' => 'Advertencias', 'url' => ''],
    ]])

    <div class="container-fluid">
        <div class="text-light fw-bold">
            <i class="fa fa-list"></i> {{ __('Alarmas con estado de advertencia') }}
        </div>

        <hr class="text-light">

        @livewire('app.sistema-status')

        <div class="row mb-3">
            <div class="col">
                <div class="card bg-dark text-light shadow-sm border-0">
                    <div class="card-header py-1 fw-bold border-primary-bottom">
                        <div class="float-start my-1 me-3">Mostrar:</div>
                        <div class="float-start me-3">
                            <select wire:model='provincia' class="form-select form-select-sm bg-dark text-light border-secondary shadow-sm">
                                <option value="" selected>Todas las provincias</option>
                                @foreach ($provincias as $provincia)
                                    <option value="{{ $provincia->id }}">{{ $provincia->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="float-start me-3">
                            <select wire:model='municipio' class="form-select form-select-sm bg-dark text-light border-secondary shadow-sm">
                                <option value="" selected>Todos los municipios</option>
                                @foreach ($municipios as $municipio)
                                    <option value="{{ $municipio->id }}">{{ $municipio->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="float-start me-3">
                            <select wire:model='centro' class="form-select form-select-sm bg-dark text-light border-secondary shadow-sm">
                                <option value="" selected>Todos los centros</option>
                                @foreach ($centros as $centro)
                                    <option value="{{ $centro->id }}">{{ $centro->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="float-start">
                            <select wire:model='dispositivo_id' class="form-select form-select-sm bg-dark text-light border-secondary shadow-sm">
                                <option value="" selected>Todos los dispositivos</option>
                                @foreach ($dispositivos as $dispositivo)
                                    <option value="{{ $dispositivo->id }}">{{ $dispositivo->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="float-end my-1 ms-2 me-3">Alarmas activas</div>
                        <div class="float-end my-1">
                            <input wire:model='activo' type="checkbox" class="form-check-input float-end">
                        </div>
                    </div>
                    <div class="card-body">
                        @if($alarmas->count() > 0)
                        <table class="table table-sm table-hover table-dark">
                            <thead>
                                <tr>
                                    <th>Nro</th>
                                    <th>Hora</th>
                                    <th>Recuperación</th>
                                    <th>Duración</th>
                                    <th>Estado</th>
                                    <th>Dispositivo</th>
                                    <th>Problema</th>
                                </tr>
                            </thead>
                            <tbody id="alarmas">
                                @foreach ($alarmas as $key => $alarma)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $alarma->created_at->format('H:i:s') }}</td>
                                        <td>
                                            @if(!$alarma->activo)
                                                {{ $alarma->updated_at->format('H:i:s') }}
                                            @else
                                                <div class="text-danger">Pendiente</div>
                                            @endif
                                        </td>
                                        <td>
                                            <?php
                                                $date1 = new DateTime($alarma->created_at);
                                                $date2 = new DateTime($alarma->updated_at);

                                                $tiempo = $date1->diff($date2);

                                                echo $tiempo->h,':',$tiempo->i,':',$tiempo->s;
                                            ?>
                                        </td>
                                        <td class="text-warning">
                                            Advertencia
                                        </td>
                                        <td>{{ $alarma->dispositivo->nombre }} - ({{ $alarma->dispositivo->ip_address }})</td>
                                        <td>{{ $alarma->message }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $alarmas->links('pagination::simple-bootstrap-5') }}
                        @else
                            <div class="text-center">
                                <h5 class="my-4">No hay alarmas de advertencias para mostrar.</h5>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
