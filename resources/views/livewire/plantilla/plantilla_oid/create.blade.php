<div>
    <form wire:submit.prevent='store'>
        <div class="h6 border-primary-bottom rounded py-2">
            <i class="fa fa-pencil fa-lg me-2 ms-1"></i> Nuevo OID
        </div>

        @include('livewire.plantilla.plantilla_oid.form')

        <div class="form-group float-end mt-3 pt-2">
            <button class="btn btn-primary me-2">
                <i class="fa fa-save"></i> {{ __('Guardar') }}
            </button>

            <button wire:click='cancelar' type="button" class="btn btn-danger">
                <i class="fa fa-ban"></i> {{ __('Cancelar') }}
            </button>
        </div>
    </form>
</div>
