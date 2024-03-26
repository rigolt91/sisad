<div>
    @livewire('breadcrumb', ['links' => [
        ['title' => 'Dashboard', 'url' => 'home'],
        ['title' => 'Dispositivos', 'url' => 'dispositivos'],
        ['title' => 'Editar dispositivo', 'url' => ''],
    ]])

    <div class="container-fluid">
        <div class="text-light fw-bold">
            <i class="fa fa-edit"></i> {{ __('Editar dispositivo') }}
            <div class="form-group float-end">
                <a wire:click='index' class="btn btn-sm btn-secondary ms-2 rounded"><i class="fa fa-arrow-left"></i></a>
            </div>
        </div>
        <hr class="text-light">

        @livewire('app.sistema-status')

        <div class="card bg-dark text-light shadow-sm border-0">
            <div class="card-body">
                <form wire:submit.prevent='update'>
                    @include('livewire.dispositivo.form')

                    <div class="form-group float-end">
                        <button type="submit" class="btn btn-primary me-2"><i class="fa fa-save"></i> Actualizar</button>
                        <button type="button" wire:click='cancelar' class="btn btn-danger"><i class="fa fa-save"></i> Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
