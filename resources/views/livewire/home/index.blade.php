<div>
    @livewire('breadcrumb', [ 'links' => [
        ['title' => 'Dashboard', 'url' => 'home'],
    ]])

    <div class="container-fluid">
        <div class="text-light">
            Información a mostrar
            <div class="float-end">
                <div class="form-group">
                    <span class="mx-3">
                        <input wire:click='setDate(0)' type="checkbox" name="rango" class="form-check-input rounded p-2" style="cursor: pointer;" @if($date==0) checked @endif>
                        <label for="ultima_hora" class="form-check-label py-1">Actual</label>
                    </span>

                    <span class="mx-3">
                        <input wire:click='setDate(1)' type="checkbox" name="rango" class="form-check-input rounded p-2" style="cursor: pointer;" @if($date==1) checked @endif>
                        <label for="ultima_hora" class="form-check-label py-1">Últimas hora</label>
                    </span>

                    <span class="mx-3">
                        <input wire:click='setDate(2)' type="checkbox" name="rango" class="form-check-input rounded p-2" style="cursor: pointer;" @if($date==2) checked @endif>
                        <label for="ultima_hora" class="form-check-label py-1">Todas</label>
                    </span>
                </div>
            </div>
        </div>

        <hr class="my-2 text-light">

        @livewire('app.sistema-status')

        @livewire('home.alarma-categorias-total', [ 'date' => $date, 'sistema' => $sistema ])

        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card bg-dark text-light shadow-sm border-0">
                    <div class="card-header border-primary-bottom py-1 fw-bold">
                        Información del Sistema
                    </div>

                    <div class="card-body" style="height: 260px;">
                        @livewire('home.info-sistema', ['sistema' => $sistema])
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card bg-dark text-light shadow-sm border-0">
                    <div class="card-header border-primary-bottom py-1 fw-bold">
                        Dispositivos por Plantilla
                    </div>

                    <div class="card-body" style="height: 260px;">
                        @livewire('home.dispositivo-plantilla', ['sistema' => $sistema])
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card bg-dark text-light shadow border-0">
                    <div class="card-header py-1 fw-bold border-primary-bottom">
                        Dispositivos Favoritos Activos
                    </div>

                    <div class="card-body" style="height: 260px;">
                        @livewire('home.favoritos', ['date' => $date, 'sistema' => $sistema])
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            @livewire('home.alarmas', [ 'date' => $date, 'sistema' => $sistema ])
        </div>
    </div>
</div>
