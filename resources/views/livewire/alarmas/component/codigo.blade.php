<div wire:poll.5000ms>
    <div class="card bg-dark text-light shadow-sm border-0" style="height: 300px;">
        <div class="card-header py-1 fw-bold border-primary-bottom">
            Por Códigos
        </div>
        <div class="card-body">
            <div class="text-success h6 border-bottom border-secondary">Conexiones Satisfactorias:<span class="float-end">{{ $codigo_alarma['success_conexion'] }}</span></div>
            <div class="text-danger h6 border-bottom border-secondary">Conexiones Erroneas:<span class="float-end">{{ $codigo_alarma['errors_conexion'] }}</span></div>
            <div class="text-success h6 border-bottom border-secondary">Equipos Satisfactorias:<span class="float-end">{{ $codigo_alarma['success_alarmas_equipos'] }}</span></div>
            <div class="text-danger h6 border-bottom border-secondary">Equipos Erroneas:<span class="float-end">{{ $codigo_alarma['errors_alarmas_equipos'] }}</span></div>
            <div class="text-warning h6 border-bottom border-secondary">Equipos Advertencias:<span class="float-end">{{ $codigo_alarma['warning_alarmas_equipos'] }}</span></div>
            <div class="text-success h6 border-bottom border-secondary">Peticiones Satisfactorias:<span class="float-end">{{ $codigo_alarma['success_request'] }}</span></div>
            <div class="text-danger h6 border-bottom border-secondary">Peticiones Erroneas:<span class="float-end">{{ $codigo_alarma['error_request'] }}</span></div>
        </div>
    </div>
</div>
