<div>
    @livewire('breadcrumb', [ 'links' => [
        ['title' => 'Dashboard', 'url' => 'home'],
        ['title' => 'Anotaciones', 'url' => 'nota.index']
    ]])

    <div class="container-fluid">
        <div class="text-light pb-2">
           <i class="fa fa-list"></i> Lista de Anotaciones
           <span class="float-end"> <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa fa-plus"></i> Nueva Anotación</button> </span>
        </div>

        <hr class="my-2 text-light">

        @livewire('app.sistema-status')

        <div class="row justify-content-start">

            @if($notas->count() > 0)
                @foreach ($notas as $key => $nota )
                <div class="col-md-3">
                    <div class="card bg-dark text-light shadow-sm border-0 mb-3">
                        <div class="card-header border-primary-bottom py-1 fw-bold">
                            {{ $nota->titulo }}
                            <span class="float-end">
                                <button data-bs-toggle="modal" data-bs-target="#destroy{{$nota->id}}" class="btn btn-sm btn-outline-danger border-0"><i class="fa fa-trash fa-lg"></i></button>

                                <div class="modal fade" id="destroy{{$nota->id}}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content bg-dark shadow">
                                            <div class="modal-header bg-danger text-white fw-bold">
                                                <h5 class="modal-title"><i class="fa fa-trash fa-lg me-3"></i> Eliminar Anotación</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form wire:submit.prevent='destroy({{ $nota->id }})' method="POST">
                                                <div class="modal-body text-white">
                                                    Esta seguro que quiere eliminar esta anotación?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                    <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Aceptar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </span>
                        </div>

                        <div class="card-body">
                            <div class="border rounded border-secondary p-2">{{ $nota->texto }}</div>
                        </div>

                        <div class="card-header text-end">
                            <hr>
                            <button wire:click='setVista({{ $nota->id }})' class="btn btn-sm btn-outline-info border-0"><i class="fa  @if($nota->vista==false) fa-eye @else fa-eye-slash @endif fa-lg"></i></button>
                        </div>
                    </div>
                </div>
                @endforeach
            @else
                <div class="col">
                    <div class="card bg-dark text-light shadow-sm border-0">
                        <div class="card-body" style="height: 260px;">
                            <h5>Lo sentimos</h5>
                            <hr class="text-light">
                            En estos momentos no hay anotaciones para mostrar.
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
