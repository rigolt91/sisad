<div class="input-group m-1" wire:poll.5000ms>
    <a href="{{ route('alarmas.satisfactorio') }}" class="btn btn-sm btn-outline-success border-0 rounded"><i class="fa fa-info-circle me-1"></i><strong class="text-light">{{ $success }}</strong></a>
    <a href="{{ route('alarmas.advertencia') }}" class="btn btn-sm btn-outline-warning  border-0 rounded"><i class="fa fa-exclamation-triangle me-1"></i><strong class="text-light">{{ $warning }}</strong></a>
    <a href="{{ route('alarmas.error') }}" class="btn btn-sm btn-outline-danger  border-0 rounded"><i class="fa fa-times-circle me-1"></i><strong class="text-light">{{ $errores }}</strong></a>
</div>
