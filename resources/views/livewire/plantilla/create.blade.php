<div>
    <form wire:submit.prevent='store'>
        <div class="form-group">
            <label for="nombre" class="form-label">Nombre de Plantilla:</label>
            <div class="input-group">
                <input type="text" wire:model='nombre' class="form-control bg-dark text-light @error('nombre') is-invalid @endError" placeholder="Escriba el nombre para esta plantilla">

                <button class="btn btn-primary rounded-end  me-2">
                    <i class="fa fa-save"></i> {{ __('Guardar') }}
                </button>

                <button wire:click='cancelar' type="button" class="btn btn-danger rounded">
                    <i class="fa fa-ban"></i> {{ __('Cancelar') }}
                </button>
            </div>
            @error('nombre') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
    </form>
</div>
