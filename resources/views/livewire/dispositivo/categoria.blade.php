<div>
    @livewire('breadcrumb', ['links' => [
        ['title' => 'Dashboard', 'url' => 'home'],
        ['title' => 'Dispositivos', 'url' => 'dispositivos'],
        ['title' => 'Dispositivos por categorías', 'url' => ''],
    ]])

    <div class="container-fluid">
        <div class="text-light fw-bold">
            <i class="fa fa-list"></i> {{ __('Dispositivos') }}

            @include('livewire.dispositivo.opciones_search')
        </div>

        <hr class="text-light">

        @livewire('app.sistema-status')

        @include('livewire.alert')

        @foreach ($plantillas as $key => $plantilla)
            <div class="card card-body bg-dark text-light shadow-sm border-0 mb-3">
                @if (count($plantilla[0]) != 0)
                    <div class="text-light border-0 border-start border-end rounded px-1">
                        <a id="btnCollapse{{$key}}" class="btn btn-sm btn-default border-0 text-light" data-bs-toggle="collapse" href="#collapseExample{{$key}}" role="button" aria-expanded="false" aria-controls="collapseExample{{$key}}">
                            <div class="h6 m-0 fw-bold"><i id="icon{{$key}}" class="fa fa-minus"></i> {{ $plantilla[0]['nombre'] }}</div>
                        </a>

                        <span class="float-end fw-bold">({{ count($plantilla[1]['dispositivos']) }})</span>
                    </div>

                    <div class="collapse show px-3 rounded" id="collapseExample{{$key}}">
                        @if (count($plantilla[1]['dispositivos']) != 0)
                            <table class="table table-dark table-sm table-hover mt-1">
                                <tbody>
                                    @foreach ($plantilla[1]['dispositivos'] as $key => $dispositivo)
                                        <tr>
                                            <td>{{ $key + 1 }} - </td>
                                            <td>{{ $dispositivo->nombre }}</td>
                                            <td class="text-end">IP:</td>
                                            <td>{{ $dispositivo->ip_address }}</td>
                                            <td class="text-end">Descripción:</td>
                                            <td>{{ $dispositivo->descripcion }}</td>
                                            <td class="text-end">Ubicación:</td>
                                            <td>
                                                {{ $dispositivo->provincia->nombre }},
                                                {{ $dispositivo->municipio->nombre }},
                                                {{ $dispositivo->ubicacion->nombre }}
                                            </td>
                                            <td class="text-end">
                                                <button wire:click='show({{ $dispositivo->id }})' type="button" class="btn btn-sm btn-outline-info border-0">
                                                    <i class="fa fa-eye fa-lg"></i>
                                                </button>
                                                @if(@Auth::user()->hasRole('administrador'))
                                                <button wire:click='edit({{ $dispositivo->id }})' type="button" class="btn btn-sm btn-outline-primary border-0">
                                                    <i class="fa fa-edit fa-lg"></i>
                                                </button>

                                                <button data-bs-toggle="modal" data-bs-target="#destroy{{$dispositivo->id}}" class="btn btn-sm btn-outline-danger border-0">
                                                    <i class="fa fa-trash fa-lg"></i>
                                                </button>

                                                <div class="modal fade" id="destroy{{$dispositivo->id}}" tabindex="-1" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content bg-dark shadow">
                                                            <div class="modal-header bg-danger text-white fw-bold">
                                                                <h5 class="modal-title"><i class="fa fa-trash fa-lg me-3"></i> Eliminar Equipo</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <form wire:submit.prevent='destroy({{ $dispositivo->id }})' method="POST">
                                                                <div class="modal-body text-white text-start">
                                                                    Esta seguro que quiere eliminar este equipo?
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                                    <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Aceptar</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="mt-3">Lo sentimos, no hay dispositivos registrados.</div>
                        @endif
                    </div>
                @endif
            </div>
        @endforeach
    </div>
</div>

@section('scripts')
    <script>
        @foreach ($plantillas as $key => $plantilla )
            let btnCollapse{{$key}} = document.querySelector('#btnCollapse{{$key}}')

            btnCollapse{{$key}}.addEventListener('click', function(){
                let icon{{$key}} = document.querySelector('#icon{{$key}}')

                if(icon{{$key}}.classList.contains('fa-plus')){
                    icon{{$key}}.classList.remove('fa-plus')
                    icon{{$key}}.classList.add('fa-minus')
                }else{
                    icon{{$key}}.classList.remove('fa-minus')
                    icon{{$key}}.classList.add('fa-plus')
                }
            })
        @endforeach
    </script>
@endsection
