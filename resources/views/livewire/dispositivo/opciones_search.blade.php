<div class="form-group float-end">
    <div class="input-group input-group-sm float-end" style="width: 800px;">
        <select wire:model='provincia' class="form-select form-select-sm bg-dark text-light me-2 border-0 rounded">
            <option value=""> Todas las Provincias</option>
            @foreach ($provincias as $provincia)
            <option value="{{ $provincia->id }}">{{ $provincia->nombre }}</option>
            @endforeach
        </select>

        <select wire:model='municipio' class="form-select form-select-sm bg-dark text-light me-2 border-0 rounded">
            <option value=""> Todos los Municipios</option>
            @foreach ($municipios as $municipio)
            <option value="{{ $municipio->id }}">{{ $municipio->nombre }}</option>
            @endforeach
        </select>

        <select wire:model='centro' class="form-select form-select-sm bg-dark text-light me-2 border-0 rounded">
            <option value=""> Todos los Cetros</option>
            @foreach ($centros as $centro)
            <option value="{{ $centro->id }}">{{ $centro->nombre }}</option>
            @endforeach
        </select>

        <input wire:model='search' type="search" class="form-control rounded-start border-dark bg-dark text-light" placeholder="{{ __('Buscar dispositivo...') }}">
        <span class="input-group-text rounded-end"><i class="fa fa-search"></i></span>
    </div>
</div>
