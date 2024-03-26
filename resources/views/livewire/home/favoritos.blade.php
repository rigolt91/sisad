<div @if($sistema==true) wire:poll.5000ms @endif>
    {{ $dispositivos->links('pagination::simple-bootstrap') }}
    <table class="table table-sm table-hover table-dark">
        <thead>
            <tr>
                <th>Dispositivo</th>
                <th><i class="fa fa-check fa-lg text-success"></i></th>
                <th><i class="fa fa-exclamation-triangle fa-lg text-warning"></i></th>
                <th><i class="fa fa-times fa-lg text-danger"></i></th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dispositivos as $key => $dispositivo)
                @if($dispositivo->alarma)
                    <tr onclick="location.href = '/dispositivos/show/{{$dispositivo->id}}'" style="cursor: pointer;">
                        <td>{{ $dispositivo->nombre }}</td>
                        <td>{{ $success = $dispositivo->alarma->getAlarma($dispositivo->id, $date, 4) }}</td>
                        <td>{{ $warning = $dispositivo->alarma->getAlarma($dispositivo->id, $date, 5) }}</td>
                        <td>{{ $error   = $dispositivo->alarma->getAlarma($dispositivo->id, $date, 3) }}</td>
                        <td>{{ $error + $warning + $success }}</td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
</div>
