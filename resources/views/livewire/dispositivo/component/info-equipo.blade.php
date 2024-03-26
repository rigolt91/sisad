<div>
    <div class="border border-secondary rounded p-1 my-2">Ip Address: {{ $dispositivo->ip_address }}</div>
    <div class="border border-secondary rounded p-1 my-2">Provincia: {{ $dispositivo->provincia->nombre }}</div>
    <div class="border border-secondary rounded p-1 my-2">Municipio: {{ $dispositivo->municipio->nombre }}</div>
    <div class="border border-secondary rounded p-1 my-2">Ubicación: {{ $dispositivo->ubicacion->nombre }}</div>
    <div class="border border-secondary rounded p-1 my-2">Descripción: {{ $dispositivo->descripcion }}</div>
    <div class="border border-secondary rounded p-1 my-2" style="height: 50px;">Observación: {{ $dispositivo->observacion }}</div>
</div>
