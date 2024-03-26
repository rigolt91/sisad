<div class="row">
    @foreach ($datas as $key => $data)
        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
            <div class="card bg-dark shadow-sm mb-3 border-0">
                <div class="card-body">
                    <div class="border-bottom text-light mb-2">
                        <i class="fa fa-area-chart"></i>
                        <strong>{{ $data['identificador'] }}</strong>
                        <div class="float-end fw-bold text-primary">
                            Actual ( <span id="data_actual_{{strtolower(strtr($data['identificador'], ' ', '_'))}}"></span> )
                        </div>
                    </div>

                    <div id="grafico_{{strtolower(strtr($data['identificador'], ' ', '_'))}}" style="height:250px;" class="text-light"></div>
                </div>
            </div>
        </div>
    @endforeach

    <input type="hidden" id="date" value="{{ $date }}">
    <input type="hidden" id="sistema" value="{{ $sistema }}">

    <script>
        const requestData = async () => {
            let datas = {
                'date': document.getElementById('date').value,
                'graficas': <?=$graficas?>,
                'dispositivo': <?=$dispositivo->id?>,
                'plantilla': <?=$dispositivo->plantilla_id?>,
            };

            const options = {
                method: "POST",
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(datas),
            };

            const response = await fetch('/api/get-datas', options);

            if(response.ok)
            {
                const data = await response.json();

                data.result.map(function(result){
                    if(result.datas.data != '')
                    {
                        let identificador = result.identificador.toLowerCase().replaceAll(' ', '_');
                        let data_actual = document.getElementById(`data_actual_${identificador}`);
                        let grafico = document.getElementById(`grafico_${identificador}`);

                        grafico.innerHTML = `<div id='${identificador}'></div>`;

                        data_actual.innerHTML = result.datas.data_actual;

                        let options = optionsGrafico(identificador, result.datas.data, result.datas.created_at);

                        var chart = new ApexCharts(document.querySelector(`#${identificador}`), options);
                        chart.render();
                    }
                });
            }
        };

        const optionsGrafico = (identificador, data, created_at) => {
            var options = {
                series: [{
                    name: identificador,
                    data: data
                }],
                chart: {
                    type: 'area',
                    height: 250,
                    zoom: {
                        autoScaleYaxis: true
                    },
                    animations: {
                        enabled: false,
                    },
                },

                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'straight',
                    width: 2
                },
                xaxis: {
                    categories: created_at,
                },
                yaxis: {
                    opposite: false
                },
                legend: {
                    horizontalAlign: 'left'
                },
                fill: {
                    type: 'gradient',
                    gradient: {
                        shadeIntensity: 1,
                        opacityFrom: 0.2,
                        opacityTo: 0.6,
                        stops: [0, 100]
                    }
                },
                tooltip: {
                    custom: function({series, seriesIndex, dataPointIndex, w}) {
                        return '<div class="arrow_box bg-dark text-light">' +
                            '<span class="p-2">' + series[seriesIndex][dataPointIndex] + '</span>' +
                        '</div>'
                    }
                }
            };

            return options;
        }

        let status_sistema = document.getElementById('sistema').value;

        requestData();

        if(status_sistema == 1)
        {
            setInterval(() => {
                requestData();
            }, 5000);
        }
    </script>
</div>
