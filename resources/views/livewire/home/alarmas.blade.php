<div @if($sistema==true) wire:poll.5000ms @endif>
    <div class="col">
        <div class="card bg-dark text-light mt-3 shadow-sm border-0">
            <div class="card-header py-1 fw-bold border-primary-bottom">
                Información actualizada / Eventos y problemas detectados / Actualizados cada 5 segundos

                <div class="float-end">
                    <div class="form-group">
                        <span class="mx-3">
                            <input wire:click='setCodigo(1)' type="checkbox" class="form-check-input rounded p-2" @if($codigo==1) checked @endif>
                            <label for="satisfactorias" class="form-check-label py-1">Satisfactorias</label>
                        </span>

                        <span class="mx-3">
                            <input wire:click='setCodigo(2)' type="checkbox" class="form-check-input rounded p-2" @if($codigo==2) checked @endif>
                            <label for="errores" class="form-check-label py-1">Advertencias</label>
                        </span>

                        <span class="mx-3">
                            <input wire:click='setCodigo(0)' type="checkbox" class="form-check-input rounded p-2" @if($codigo==0) checked @endif>
                            <label for="errores" class="form-check-label py-1">Errores</label>
                        </span>

                        <span class="mx-3">
                            <input wire:click='setCodigo' type="checkbox" class="form-check-input rounded p-2" @if($codigo=='') checked @endif>
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
                    <tbody>
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
