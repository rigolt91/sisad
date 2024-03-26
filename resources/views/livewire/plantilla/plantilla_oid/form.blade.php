<div>
    <div class="row">
        <div class="col col-md-6">
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="identificador" class="form-label">Identificador del OID</label>
                        <input type="text" wire:model='identificador' class="form-control bg-dark text-light @error('identificador') is-invalid @endError" placeholder="Escriba el texto que identificara el OID">
                        @error('identificador') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                @if($tipo_oid == 5)
                <div class="col">
                    <div class="form-group">
                        <label for="comando" class="form-label">Comando</label>
                        <select wire:model='comando' class="form-select bg-dark text-light @error('comando') is-invalid @endError">
                            <option value="">Seleccione el comando para esta alarma</option>
                            @foreach ($comandos as $cmd)
                            <option value="{{ $cmd->id }}" {{ ($cmd->id==$comando ? 'selected' : '') }}>{{ $cmd->identificador }}</option>
                            @endforeach
                        </select>
                        @error('comando') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                @endif
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-group mt-2">
                        <label for="oid" class="form-label">Valor de OID</label>
                        <input type="text" wire:model='oid' class="form-control bg-dark text-light @error('oid') is-invalid @endError" placeholder="Escriba el valor del OID">
                        @error('oid') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                @if($tipo_oid == 1 || $tipo_oid == 5)
                <div class="col">
                    <div class="form-group mt-2">
                        <label for="status_ok" class="form-label">Valor del Estado Correcto</label>
                        <input type="text" wire:model='status_ok' class="form-control bg-dark text-light @error('status_ok') is-invalid @endError" placeholder="Escriba el valor en el cual la alarma es correcta">
                        @error('status_ok') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                @endif
            </div>
        </div>
        <div class="col col-md-6">
            <div class="form-group">
                <label for="tipo_oid" class="form-label">Categoría del OID</label>
                <div class="form-group border @error('tipo_oid') border-danger @endError rounded p-1" style="padding-top:6px; padding-bottom:6px;">
                    <div class="form-group">
                        <input type="radio" wire:model='tipo_oid' name="tipo_oid" class="form-ckeck-input pe-1" value="1"> {{ __('Alarma') }}
                    </div>
                    <div class="form-group">
                        <input type="radio" wire:model='tipo_oid' name="tipo_oid" class="form-ckeck-input pe-1" value="2"> {{ __('Información') }}
                    </div>
                    <div class="form-group">
                        <input type="radio" wire:model='tipo_oid' name="tipo_oid" class="form-ckeck-input pe-1" value="3"> {{ __('Grafico') }}
                    </div>
                    <div class="form-group">
                        <input type="radio" wire:model='tipo_oid' name="tipo_oid" class="form-ckeck-input pe-1" value="4"> {{ __('Comando') }}
                    </div>
                    <div class="form-group">
                        <input type="radio" wire:model='tipo_oid' name="tipo_oid" class="form-ckeck-input pe-1" value="5"> {{ __('Alarma para Comando') }}
                    </div>
                </div>
                @error('tipo_oid') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>
    </div>
</div>
