<div>
    @livewire('breadcrumb', ['links' => [
        ['title' => 'Dashboard', 'url' => 'home'],
        ['title' => 'Alarmas', 'url' => 'alarmas'],
        ['title' => 'Todas las alarmas', 'url' => ''],
    ]])

    <div class="container-fluid">
        <div class="text-light fw-bold">
            <i class="fa fa-list"></i> {{ __('Todas las alarmas') }}
        </div>

        <hr class="text-light">

        @livewire('app.sistema-status')

        <div class="row">
            <div class="col">
                <div class="card bg-dark text-light shadow-sm border-0" style="height: 300px;">
                    <div class="card-header py-1 fw-bold border-primary-bottom">
                        Total
                    </div>
                    <div class="card-body">
                        <div id="total_alarmas" class="pt-1" style="height: 210px;"></div>
                    </div>
                </div>
            </div>
            <div class="col">
                @livewire('alarmas.component.codigo')
            </div>
            <div class="col">
                <div class="card bg-dark text-light shadow-sm border-0" style="height: 300px;">
                    <div class="card-header py-1 fw-bold border-danger-bottom">
                        Favoritos
                    </div>
                    <div class="card-body">
                        @livewire('home.favoritos')
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                @livewire('home.alarmas')
            </div>
        </div>
    </div>
</div>

@section('scripts')
    <script>
        (async() => {
            const options = {
                method: "GET",
                headers: {
                    'Content-Type': 'application/json',
                },
            };

            const response = await fetch('/api/get-all-data', options);

            if(response.ok)
            {
                const data = await response.json();

                graficoTotalAlarmas(data.alarmas);
            }
        })();

        const graficoTotalAlarmas = (data) => {
            var options = {
                chart: {
                    type: 'pie',
                    width: '100%',
                    height: '210px'
                },
                series: data,
                labels: [`<span class="text-light">Satisfactorio (${data[0]})</span>`, `<span class="text-light">Errores (${data[1]})</span>`, `<span class="text-light">Advertencias (${data[2]})</span>`, `<span class="text-info fw-bold">Total de Alarmas ${data[0] + data[1] + data[2]}</span>`],
                colors: ['#198754', '#dc3545', '#ffc107', '#fff'],
            }

            var chart = new ApexCharts(document.querySelector("#total_alarmas"), options);
            chart.render();
        }

        setInterval(() => {
            graficoTotalAlarmas();
        }, 5000);
    </script>
@endsection
