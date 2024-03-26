<div class="row">
    <div class="col-6">
        <div class="form-group mb-2">
            <label for="nombre">Nombre</label>
            <input wire:model='nombre' type="text" class="@error('nombre') is-invalid border-danger @enderror form-control bg-dark text-light" placeholder="Escriba el nombre para el dispositivo">
            @error('nombre')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group mb-2">
            <label for="ip_address">IP Address</label>
            <input wire:model='ip_address' type="text" class="@error('ip_address') is-invalid border-danger @enderror form-control bg-dark text-light" placeholder="Escriba la dirección ip del dispositivo">
            @error('ip_address')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group mb-2">
            <label for="comunidad">Comunidad</label>
            <input wire:model='comunidad' type="text" class="@error('comunidad') is-invalid border-danger @enderror form-control bg-dark text-light" placeholder="Comunidad del dispositivo, ejemplo 'public'">
            @error('comunidad')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group mb-2">
            <label for="descripcion">Descripción</label>
            <input wire:model="descripcion" type="text" class="@error('descripcion') is-invalid border-danger @enderror form-control bg-dark text-light" placeholder="Breve descripción del dispositivo">
            @error('descripcion')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group mb-2">
            <label for="observacion">Observación</label>
            <textarea wire:model='observacion' class="@error('observacion') is-invalid border-danger @enderror form-control bg-dark text-light" cols="30" rows="4" placeholder="Observaciones a tener encuenta sobre el dispositivo"></textarea>
            @error('observacion')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="categoria">Plantilla</label>
            <div class="input-group">
                @if(!$add_plantilla)
                    <select wire:model='plantilla' class="@error('plantilla') is-invalid border-danger @enderror form-select bg-dark text-light">
                        <option value="" disabled selected>Seleccione la plantilla a utilizar para este dispositivo</option>
                        @foreach($plantillas as $pl)
                        <option value="{{ $pl->id }}" {{ $plantilla == $pl->id ? 'selected' : '' }} >{{ $pl->nombre }}</option>
                        @endforeach
                    </select>
                    <button wire:click='addPlantilla' type="button" class="btn btn-primary"><i class="fa fa-plus"></i></button>
                @else
                    <input wire:model='plantilla' type="text" class="@error('plantilla') is-invalid border-danger @enderror form-control bg-dark text-light" placeholder="Escriba un nombre para la plantilla">
                    <button wire:click='storePlantilla' type="button" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
                @endif
            </div>
            @error('plantilla')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-6">
        <div class="form-group mb-2">
            <label for="provincia">Provincia</label>
            <div class="input-group">
                @if(!$add_provincia)
                    <select wire:model='provincia' class="@error('provincia') is-invalid border-danger @enderror form-select bg-dark text-light">
                        <option value="" disabled selected>Seleccione la provincia a la que pertenece el dispositivo</option>
                        @foreach($provincias as $provinciaEqp)
                        <option value="{{ $provinciaEqp->id }}" {{ $provincia == $provinciaEqp->id ? 'selected' : '' }}>{{ $provinciaEqp->nombre }}</option>
                        @endforeach
                    </select>
                    <button wire:click='addProvincia' type="button" class="btn btn-primary"><i class="fa fa-plus"></i></button>
                @else
                    <input wire:model='provincia' type="text" class="@error('provincia') is-invalid border-danger @enderror form-control bg-dark text-light" placeholder="Escriba el nombre de la provincia">
                    <button wire:click='storeProvincia' type="button" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
                @endif
            </div>
            @error('provincia')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group mb-2">
            <label for="municipio">Municipio</label>
            <div class="input-group">
                @if(!$add_municipio)
                    <select wire:model='municipio' class="@error('municipio') is-invalid border-danger @enderror form-select bg-dark text-light">
                        <option value="" disabled selected>Seleccione municipio al que pertenece el dispositivo</option>
                        @foreach($municipios as $municipioEqp)
                        <option value="{{ $municipioEqp->id }}" {{ $municipio == $municipioEqp->id ? 'selected' : '' }}>{{ $municipioEqp->nombre }}</option>
                        @endforeach
                    </select>
                    <button wire:click='addMunicipio' type="button" class="btn btn-primary"><i class="fa fa-plus"></i></button>
                @else
                    <input wire:model='municipio' type="text" class="@error('municipio') is-invalid border-danger @enderror form-control bg-dark text-light" placeholder="Escriba el nombre del municipio">
                    <button wire:click='storeMunicipio' type="button" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
                @endif
            </div>
            @error('municipio')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group mb-2">
            <label for="ubicacion">Ubicación</label>
            <div class="input-group">
                @if(!$add_ubicacion)
                    <select wire:model='ubicacion' class="@error('ubicacion') is-invalid border-danger @enderror form-select bg-dark text-light">
                        <option value="" disabled selected>Seleccione la ubicación del dispositivo</option>
                        @foreach($ubicaciones as $ubicacionEqp)
                        <option value="{{ $ubicacionEqp->id }}" {{ $ubicacion == $ubicacionEqp->id ? 'selected' : '' }}>{{ $ubicacionEqp->nombre }}</option>
                        @endforeach
                    </select>
                    <button wire:click='addUbicacion' type="button" class="btn btn-primary"><i class="fa fa-plus"></i></button>
                @else
                    <input wire:model='ubicacion' type="text" class="@error('ubicacion') is-invalid border-danger @enderror form-control bg-dark text-light" placeholder="Escriba el nombre de la ubicación">
                    <button wire:click='storeUbicacion' type="button" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
                @endif
            </div>
            @error('ubicacion')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group mb-2">
            <label for="imagen">Imágen del equipo</label>
            <div class="input-group">
                <input type="file" wire:model='imagen' class="@error('imagen') is-invalid border-danger @enderror form-control bg-dark" placeholder="Subir una imagen del dispositivo" disabled>
            </div>
            @error('imagen')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="version_snmp">Versión Snmp del equipo</label>
            <div class="border rounded p-3 border-light">
                <div class="form-check">
                    <input class="form-check-input" type="radio" wire:model='version_snmp' value="1" disabled>
                    <label class="form-check-label" for="version_snmp1">
                        Version snmp 1
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" wire:model='version_snmp' value="2">
                    <label class="form-check-label" for="version_snmp2">
                        Version snmp 2
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" wire:model='version_snmp' value="3" disabled>
                    <label class="form-check-label" for="version_snmp3">
                        Version snmp 3
                    </label>
                </div>
            </div>
        </div>

        @error('version_snmp')
            <span class="text-danger">{{ $message }}</span>
        @enderror
        <div class="form-check form-switch border border-light rounded my-4">
            <div class="mx-3 my-2">
                <input class="form-check-input p-2"  type="checkbox" role="switch" wire:model='favorito' id="favorito" value="1">
                <label class="form-check-label" for="favorito">Añadir a favoritos</label>
            </div>
        </div>
    </div>
</div>
