<div>
    @livewire('breadcrumb', ['links' => [
        ['title' => 'Dashboard', 'url' => 'home'],
        ['title' => 'Plantillas', 'url' => 'plantillas'],
        ['title' => "Plantilla - $nombre", 'url' => ''],
    ]])

    <div class="container-fluid">
        <div class="text-light fw-bold">
            <i class="fa fa-list"></i> {{ __('Datos de la plantilla') }}
            <div class="form-group float-end">
                <div class="input-group input-group-sm float-end">
                    <input wire:model='search' type="search" class="form-control rounded-start bg-dark text-light" placeholder="{{ __('Buscar...') }}">
                    <span class="input-group-text rounded-end"><i class="fa fa-search"></i></span>

                    <button wire:click='create' class="btn btn-sm btn-success ms-2 rounded"><i class="fa fa-plus"></i></button>
                </div>
            </div>
        </div>

        <hr class="text-light">

        @livewire('app.sistema-status')

        @include('livewire.alert')

        @if (!empty($view))
            <div class="card bg-dark text-light shadow-sm border-0">
                <div class="card-body">
                        @include("livewire.plantilla.plantilla_oid.$view")
                </div>
            </div>
        @endif
    </div>
</div>
