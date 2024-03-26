@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col">

            <div class="card shadow my-4">
                <div class="card-header">
                    <h3>Resultados</h3>
                </div>

                <div class="card-body">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Nro</th>
                                <th>Dispositivo</th>
                                <th>Plantilla</th>
                                <th>Plantilla_oid</th>
                                <th>Valor</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($results as $key => $result)
                            <tr>
                                <td>{{ $key }}</td>
                                <td>{{ $result['dispositivo_id'] }}</td>
                                <td>{{ $result['plantilla_id'] }}</td>
                                <td>{{ $result['plantilla_oid_id'] }}</td>
                                <td>{{ $result['data'] }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
