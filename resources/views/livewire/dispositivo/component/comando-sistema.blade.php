<div>
    @foreach ($comandos as $comando)
        @if($comando->infoEquipo->count() > 0)
            <div class="col-sm-12 col-md-6 col-lg-12 col-xl-12">
                <div class="border-bottom rounded border-secondary py-1 my-2">
                    <div class="btn btn-sm
                        @if ($comando->status_ok != $comando->infoEquipo->last()->data)
                            btn-danger
                        @else
                            btn-success
                        @endif
                        p-1 px-2 mx-1">

                        <i class="fa fa-lightbulb fa-lg"></i>
                    </div>

                    <button id="button" value="{{ $comando->id }}" wire:click='resetComando({{ $comando }})' type="button" class="btn btn-sm btn-primary me-2" {{ $button_status }} {{ $status }}>
                        @if(empty($button_status))
                            <i class="fa fa-undo"></i>
                        @else
                            <i class="fa fa-spinner fa-pulse"></i>
                        @endif
                    </button>

                    {{ $comando->identificador }}
                </div>
            </div>
        @endif
    @endforeach
</div>
