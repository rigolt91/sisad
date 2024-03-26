<div>
    <table class="table table-sm table-dark table-hover">
        <thead>
            <tr>
                <th>No</th>
                <th>Nombre de plantilla</th>
                <th class="text-center">Total de Oids</th>
                <th class="pe-0" width="30%">
                    <select wire:model='paginas' class="form-select form-select-sm bg-dark text-light ms-2 border-0 rounded">
                        <option value="5"> &nbsp;&nbsp;5 oids por página</option>
                        <option value="10">10 oids por página</option>
                        <option value="15">15 oids por página</option>
                        <option value="20">20 oids por página</option>
                    </select>
                </th>
            </tr>
        </thead>
        <tbody>
        @foreach ($plantillas as $key => $plantilla)
            <tr>
                <td class="text-light">
                    {{ $key+1 }}
                </td>
                <td class="text-light">
                    {{ $plantilla->nombre }}
                </td>
                <td class="text-light text-center">
                    {{ $plantilla->plantillaOid->count() }}
                </td>
                <td class="text-light text-end">
                    <button wire:click='show({{ $plantilla->id }})' type="button" class="btn btn-sm btn-outline-info border-0">
                        <i class="fa fa-eye fa-lg"></i>
                    </button>
                    <button wire:click='edit({{ $plantilla->id }})' type="button" class="btn btn-sm btn-outline-primary border-0">
                        <i class="fa fa-edit fa-lg"></i>
                    </button>
                    <button wire:click='destroy({{ $plantilla->id }})' class="btn btn-sm btn-outline-danger border-0">
                        <i class="fa fa-trash fa-lg"></i>
                    </button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $plantillas->links('pagination::simple-bootstrap-5') }}
</div>
