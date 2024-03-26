<div>
    @foreach ($info_sistema as $info)
        <div class="border border-secondary rounded p-1 my-2">
            {{ $info->identificador }}:

            @if($info->infoEquipo->count() > 0)
                {{ $info->infoEquipo->first()->data }}
            @else
                <span>Sin Datos</span>
            @endif
        </div>
    @endforeach
</div>
