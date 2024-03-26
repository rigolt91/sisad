<div>
    @livewire('breadcrumb', ['links' => [
        ['title' => 'Dashboard', 'url' => 'home'],
        ['title' => 'Plantillas', 'url' => 'plantillas'],
        ['title' => 'Todas las plantillas', 'url' => ''],
    ]])

    <div class="container-fluid">
        <div class="text-light fw-bold">
            <i class="fa fa-list"></i> {{ __('Plantillas') }}
            <div class="form-group float-end">
                <div class="input-group input-group-sm float-end">
                    <input wire:model='search' type="search" class="form-control rounded-start bg-dark text-light border-0" placeholder="{{ __('Buscar plantilla...') }}">
                    <span class="input-group-text rounded-end"><i class="fa fa-search"></i></span>

                    <a wire:click='create' class="btn btn-sm btn-success ms-2 rounded"><i class="fa fa-plus"></i></a>
                </div>
            </div>
        </div>
        <hr class="text-light">

        @livewire('app.sistema-status')

        @include('livewire.alert')

        @if($view)
            <div class="card bg-dark text-light shadow-sm border-0 mb-3">
                <div class="card-body">
                    @include("livewire.plantilla.$view")
                </div>
            </div>
        @endif

        @if($view !== 'index')
            <div class="card bg-dark text-light shadow">
                <div class="card-body">
                    @include('livewire.plantilla.plantillas')
                </div>
            </div>
        @endif
    </div>
</div>
