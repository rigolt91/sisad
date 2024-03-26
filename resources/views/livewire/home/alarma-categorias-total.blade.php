<div class="row" wire:poll.5000ms>
    <div class="col">
        <a href="{{ route('nota.index') }}" class="nav-link">
            <div class="card card-body bg-dark mb-3 shadow-sm p-0 text-light border-0">
                <div class="border-rounded">
                    <span class="bg-info pt-2 me-3 rounded-start float-start text-light text-center" style="width: 50px; height: 50px;">
                        <i class="fa fa-edit h2"></i>
                    </span>
                    <div class="fw-bold mt-3 px-4">Anotaciones <span class="float-end text-info h5 fw-bold">{{ $notas  }}</span></div>
                </div>
            </div>
        </a>
    </div>
    <div class="col">
        <div class="card card-body bg-dark mb-3 shadow-sm p-0 text-light border-0">
            <div class="border-rounded">
                <span class="bg-secondary pt-2 me-3 rounded-start float-start text-light text-center" style="width: 50px; height: 50px;">
                    <i class="fa fa-tv h2"></i>
                </span>
                <div class="fw-bold">
                    <div class="text-success me-4">Activos <span class="float-end"><span class="fw-bold">{{ ($alarmas['success']->count() > 0 && $sistema==1 ? $alarmas['success']->count() : 0) }}</span></span></div>
                    <hr class="m-0">
                    <div class="text-danger me-4">Desconectados <span class="float-end"><span class="fw-bold">{{ ($alarmas['errors']->count() > 0 && $sistema==1 ? $alarmas['errors']->count() : 0) }}</span></span></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col">
        <a href="{{ route('alarmas.satisfactorio') }}" class="nav-link">
            <div class="card card-body bg-dark mb-3 shadow-sm p-0 text-light border-0">
                <div class="border-rounded">
                    <span class="bg-success pt-2 me-3 rounded-start float-start text-light text-center" style="width: 50px; height: 50px;">
                        <i class="fa fa-check h2"></i>
                    </span>
                    <div class="fw-bold mt-3 px-4">Satisfactorio <span class="float-end text-success h5 fw-bold">{{ ($alarmas['alarma_success']->count() > 0 ? $alarmas['alarma_success']->count() : 0) }}</span></div>
                </div>
            </div>
        </a>
    </div>
    <div class="col">
        <a href="{{ route('alarmas.advertencia') }}" class="nav-link">
            <div class="card card-body bg-dark mb-3 shadow-sm p-0 text-light border-0">
                <div class="border-rounded">
                    <span class="bg-warning pt-2 me-3 rounded-start float-start text-light text-center" style="width: 50px; height: 50px;">
                        <i class="fa fa-exclamation-triangle h2"></i>
                    </span>
                    <div class="fw-bold mt-3 px-4">Advertencias <span class="float-end text-warning h5 fw-bold">{{ ($alarmas['alarma_warning']->count() > 0 ? $alarmas['alarma_warning']->count() : 0) }}</span></div>
                </div>
            </div>
        </a>
    </div>
    <div class="col">
        <a href="{{ route('alarmas.error') }}" class="nav-link">
            <div class="card card-body bg-dark mb-3 shadow-sm p-0 text-light border-0">
                <div class="border-rounded">
                    <span class="bg-danger pt-2 me-3 rounded-start float-start text-light text-center" style="width: 50px; height: 50px;">
                        <i class="fa fa-times h2"></i>
                    </span>
                    <div class="fw-bold mt-3 px-4">Errores <span class="float-end text-danger h5 fw-bold">{{ ($alarmas['alarma_errors']->count() > 0 ? $alarmas['alarma_errors']->count() : 0) }}</span></div>
                </div>
            </div>
        </a>
    </div>
</div>
