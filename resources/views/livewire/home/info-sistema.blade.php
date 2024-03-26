<div>
    <table class="table table-sm table-hover table-dark">
        <thead>
            <tr>
                <th>Parámetro</th>
                <th>Valor</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Estado del Servidor</td>
                <td>
                    @if($status_sistema == 1)
                        <i class="fa fa-play fa-lg text-success"></i> <span class="text-success"> Corriendo</span>
                    @else
                        <i class="fa fa-stop fa-lg text-danger"></i> <span class="text-danger"> Detenido</span>
                    @endif
                </td>
            </tr>
            <tr>
                <td>Número de Dispositivos</td>
                <td>{{ $total_equipos }}</td>
            </tr>
            <tr>
                <td>Dispositivos Favoritos</td>
                <td>{{ $favoritos }}</td>
            </tr>
            <tr>
                <td>Número de Plantillas</td>
                <td>{{ $total_plantillas }}</td>
            </tr>
            <tr>
                <td>Número de Oids</td>
                <td>{{ $total_oids }}</td>
            </tr>
            <tr>
                <td>Hora</td>
                <td class="h5 text-primary"> <div id="hora"></div> </td>
            </tr>
        </tbody>
    </table>

    <script>
        let hora = document.getElementById('hora');

        setInterval(() => {
            var myDate = new Date();

            hours = myDate.getHours();
            minutes = myDate.getMinutes();
            seconds = myDate.getSeconds();

            hora.innerHTML = hours+ ":" +minutes+ ":" +seconds;

        }, 1000);
    </script>
</div>
