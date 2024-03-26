<div>
    @livewire('breadcrumb', ['links' => [
        ['title' => 'Dashboard', 'url' => 'home'],
        ['title' => 'Dispositivos', 'url' => 'dispositivos'],
        ['title' => 'Dispositivo - '.$dispositivo->ip_address, 'url' => ''],
    ]])

    @include('livewire.alert')

    <div class="container-fluid">

        <div class="text-light fw-bold">
            <i class="fa fa-list"></i> {{ __('Datos del dispositivo') }}

            <div class="float-end">
                <div class="form-group">
                    <span class="mx-3">
                        <input wire:model='date' wire:click='setCarbon' type="radio" role="switch" name="rango" value="0" class="form-check-input rounded-0 p-2">
                        <label for="actual" class="form-check-label py-1">Actual</label>
                    </span>

                    <span class="mx-3">
                        <input wire:model='date' wire:click='setCarbon' type="radio" role="switch" name="rango" value="1" class="form-check-input rounded-0 p-2">
                        <label for="ultima_hora" class="form-check-label py-1">Última hora</label>
                    </span>
                </div>
            </div>
        </div>

        <hr class="text-light">

        @livewire('app.sistema-status')

        @if($alarmas->count() > 0)
            @livewire('dispositivo.component.info-alarmas', [ 'alarmas' => $alarmas])
        @endif

        <div class="row">
            <div class="col-xl-3 col-lg-4 col-md-12 col-sm-12">
                @if($comandos->count() > 0)
                    <div class="card bg-dark text-light shadow-sm mb-3 border-0">
                        <div class="card-body">
                            <div class="card-title border-bottom">Comandos del Sistema</div>

                            <div class="row">
                                @livewire('dispositivo.component.comando-sistema', [ 'dispositivo' => $dispositivo, 'comandos' => $comandos ])
                            </div>
                        </div>
                    </div>
                @endif

                @if($info_sistema->count() > 0)
                    <div class="card bg-dark text-light shadow-sm mb-3 border-0">
                        <div class="card-body">
                            <div class="card-title border-bottom fw-bold">Información del Sistema</div>
                            @livewire('dispositivo.component.info-sistema', [ 'info_sistema' => $info_sistema ])
                        </div>
                    </div>
                @endif

                <div class="card bg-dark text-light shadow-sm mb-3 border-0">
                    <div class="card-body">
                        <div class="card-title border-bottom fw-bold">Informacion del Dispositivo</div>

                        @livewire('dispositivo.component.info-equipo', [ 'dispositivo' => $dispositivo ])
                    </div>
                </div>
            </div>

            <div class="col-xl-9 col-lg-8 col-md-12 col-sm-12">
                @livewire('dispositivo.component.graficar', [ 'sistema' => $sistema, 'graficas' => $graficas, 'dispositivo' => $dispositivo, 'date' => $date ])
            </div>
        </div>
    </div>
</div>
