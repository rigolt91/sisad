<div class="bg-white mx-2 rounded">
    <ol class="breadcrumb p-1 px-3">
        @foreach ($links as $link)
            <li class="breadcrumb-item active" aria-current="page">
                @if($link['url'] == '')
                    {{ __($link['title']) }}
                @else
                    <a class="btn btn-outline-default border-0 p-0" href="{{ route($link['url']) }}" style="">{{ __($link['title']) }}</a>
                @endif
            </li>
        @endforeach
    </ol>
</div>
