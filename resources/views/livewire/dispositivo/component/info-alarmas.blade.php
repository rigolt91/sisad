<div wire:poll.5000ms>
    <div class="row mb-2">
        @if($alarmas->count() > 0)
            @foreach ($alarmas as $alarma)
                <div class="col">
                    <div class="alert text-light text-center py-1 px-2 shadow-sm border-0 @if($alarma->infoAlarma->count() > 0 && $alarma->status_ok == $alarma->infoAlarma->first()->data) bg-success @else bg-danger @endif" style="height:80%;">
                        {{ $alarma->identificador }}
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>
