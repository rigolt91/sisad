<div>
    <table class="table table-sm table-dark table-hover shadow-sm">
        <thead class="text-light">
            <tr>
                <th>No.</th>
                <th>Identificador</th>
                <th>Tipo Oid</th>
                <th>OID</th>
                <th class="pe-0" width="15%">
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
            @foreach ($oids as $key=> $oid)
                <tr>
                    <td class="text-light">{{ $key+1 }}</td>
                    <td class="text-light">{{ $oid->identificador }}</td>
                    <td class="text-light">
                        @switch($oid->tipo_oid)
                            @case(1)
                                Alarma
                                @break
                            @case(2)
                                Información
                                @break
                            @case(3)
                                Gráfico
                                @break
                            @case(4)
                                Comando
                                @break
                            @case(5)
                                Alarma para el comando <strong>({{ $oid->oidAlarmaComando->comando($oid->oidAlarmaComando->comando_id)->identificador }})</strong>
                                @break
                        @endswitch
                    </td>
                    <td class="text-light">{{ $oid->oid }}</td>
                    <td class="text-light">
                        <button type="button" wire:click="destroy({{ $oid->id }})" class="btn btn-sm btn-outline-danger border-0 float-end"><i class="fa fa-trash fa-lg"></i></button>
                        <button type="button" wire:click="edit({{ $oid->id }})" class="btn btn-sm btn-outline-primary border-0 float-end"><i class="fa fa-edit fa-lg"></i></button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $oids->links('vendor.pagination.simple-bootstrap-5') }}
</div>
