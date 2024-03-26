<div>
    <div id="chart" class="pt-1"></div>

    @section('scripts')
        <script>
            var options = {
                chart: {
                    type: 'donut',
                    width: '100%',
                    height: '210px'
                },
                legend: {
                    show: true,
                    fontSize: '14px',
                    fontFamily: 'Nunito, sans-serif',
                    fontWeight: 400,
                    labels: {
                        colors: '#fff'
                    },
                },
                series: <?=json_encode($plantilla_equipos) ?>,
                labels: <?=json_encode($plantillas) ?>,
            }

            var chart = new ApexCharts(document.querySelector("#chart"), options);

            chart.render();
        </script>
    @endsection
</div>
