<div wire:poll.5000ms>
    @livewire('breadcrumb', ['links' => [
        ['title' => 'Dashboard', 'url' => 'home'],
        ['title' => 'Alarmas', 'url' => 'alarmas'],
        ['title' => 'Alarmas por dispositivos', 'url' => ''],
    ]])

    <div class="container-fluid">
        <div class="text-light fw-bold">
            <i class="fa fa-list"></i> {{ __('Alarmas por dispositivos') }}
        </div>

        <hr class="text-light">

        @livewire('app.sistema-status')

        <div class="row mb-3">
            <div class="col-6">
                <div class="card bg-dark text-light shadow-sm border-0" style="height: 478px;">
                    <div class="card-header py-1 fw-bold border-primary-bottom">
                        Dispositivos
                    </div>
                    <div class="card-body">
                        @if($dispositivos->count() > 0)
                        <table class="table table-sm table-hover table-dark">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Ip_address</th>
                                    <th>Plantilla</th>
                                    <th>Provincia</th>
                                    <th>Municipio</th>
                                    <th>Centro Técnico</th>
                                    <th><i class="fa fa-eye"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dispositivos as $key => $dispositivo)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $dispositivo->ip_address }}</td>
                                    <td>{{ $dispositivo->plantilla->nombre }}</td>
                                    <td>{{ $dispositivo->provincia->nombre }}</td>
                                    <td>{{ $dispositivo->municipio->nombre }}</td>
                                    <td>{{ $dispositivo->ubicacion->nombre }}</td>
                                    <td>
                                        <input type="checkbox" wire:click='verEquipo({{ $dispositivo->id }})' class="form-check-input" value="{{ $dispositivo_id }}" @if($dispositivo->id == $dispositivo_id) checked @endif>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                            <div class="text-center"><h4>No hay dispositivos registrados</h4></div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card bg-dark text-light shadow-sm border-0 mb-3" style="height: 230px;">
                    <div class="card-header py-1 fw-bold border-success-bottom">
                        Satisfactorias
                    </div>
                    <div class="card-body row">
                        @if (!empty($success))
                            @foreach ($success as $succes)
                                <div class="col bg-success shadow rounded p-1 m-1">{{ $succes }}</div>
                            @endforeach
                        @else
                            <div class="text-center py-4 text-info">
                                <h5>Sin alarmas satisfactorias a mostrar</h5>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="card bg-dark text-light shadow-sm border-0" style="height: 230px;">
                    <div class="card-header py-1 fw-bold border-danger-bottom">
                        Erroneas
                    </div>
                    <div class="card-body row">
                        @if (!empty($errores))
                            @foreach ($errores as $error)
                                <div class="col bg-danger shadow rounded p-1 m-1">{{ $error }}</div>
                            @endforeach
                        @else
                            <div class="text-center py-4 text-info">
                                <h5>Sin alarmas erroneas para mostrar</h5>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="card bg-dark text-light shadow-sm border-0">
                    <div class="card-header py-1 fw-bold border-primary-bottom">
                        Todas

                        <div class="float-end">
                            <div class="form-group">
                                <span class="mx-3">
                                    <input wire:model='activo' type="checkbox" role="switch" value="1" class="form-check-input p-2">
                                    <label for="activas" class="form-check-label py-1">Activas</label>
                                </span>

                                <span class="mx-3">
                                    <input wire:model='codigo' type="radio" role="switch" name="opcion_alarma" value="1" class="form-check-input rounded p-2">
                                    <label for="satisfactorias" class="form-check-label py-1">Satisfactorias</label>
                                </span>

                                <span class="mx-3">
                                    <input wire:model='codigo' type="radio" role="switch" name="opcion_alarma" value="2" class="form-check-input rounded p-2">
                                    <label for="advertencias" class="form-check-label py-1">Advertencias</label>
                                </span>

                                <span class="mx-3">
                                    <input wire:model='codigo' type="radio" role="switch" name="opcion_alarma" value="0" class="form-check-input rounded p-2">
                                    <label for="errores" class="form-check-label py-1">Errores</label>
                                </span>

                                <span class="mx-3">
                                    <input wire:model='codigo' type="radio" role="switch" name="opcion_alarma" value="" class="form-check-input rounded p-2">
                                    <label for="errores" class="form-check-label py-1">Todas</label>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
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
                                    @if ($alarma->dispositivo->activo == 1)
                                        <tr onclick="location.href = '/dispositivos/show/{{$alarma->dispositivo->id}}'" style="cursor: pointer;">
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $alarma->created_at->format('H:i:s') }}</td>
                                            <td>
                                                @if(!$alarma->activo || $alarma->codigo == 1 || $alarma->codigo == 4 || $alarma->codigo == 7)
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
                                            <td class="@if($alarma->codigo == 0 || $alarma->codigo == 3 || $alarma->codigo == 6 && $alarma->activo == true) text-danger @endif @if($alarma->codigo == 1 || $alarma->codigo == 4 || $alarma->codigo == 7) text-success @endif @if($alarma->codigo == 2 || $alarma->codigo == 5) text-warning @endif">
                                                @if($alarma->codigo == 0 || $alarma->codigo == 3 || $alarma->codigo == 6 && $alarma->activo == true)
                                                    Error
                                                @elseif ($alarma->codigo == 1 || $alarma->codigo == 4 || $alarma->codigo == 7)
                                                    Satisfactorio
                                                @elseif($alarma->codigo == 2 || $alarma->codigo == 5)
                                                    Advertencia
                                                @endif
                                            </td>
                                            <td>{{ $alarma->dispositivo->nombre }} - ({{ $alarma->dispositivo->ip_address }})</td>
                                            <td>{{ $alarma->message }}</td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                        {{ $alarmas->links('pagination::simple-bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
