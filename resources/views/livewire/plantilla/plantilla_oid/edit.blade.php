<div>
    <form wire:submit.prevent='update({{ $oid_id }})'>
        <div class="h6 border-primary-bottom rounded py-2">
            <i class="fa fa-edit fa-lg me-2 ms-1"></i> Editar OID
        </div>

        @include('livewire.plantilla.plantilla_oid.form')

        <div class="form-group float-end pt-2">
            <button class="btn btn-primary me-2">
                <i class="fa fa-save"></i> {{ __('Actualziar') }}
            </button>

            <button wire:click='cancelar' type="button" class="btn btn-danger">
                <i class="fa fa-ban"></i> {{ __('Cancelar') }}
            </button>
        </div>
    </form>
</div>
