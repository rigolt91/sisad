@if ($paginator->hasPages())
<div class="float-end">
    <nav role="navigation" aria-label="Pagination Navigation">
        <ul class="pagination mb-1">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link"><i class="fa fa-arrow-left"></i></span>
                </li>
            @else
                <li class="page-item">
                    <button class="page-link" wire:click="previousPage" rel="prev">
                        <i class="fa fa-arrow-left"></i>
                    </button>
                </li>
            @endif

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <button class="page-link" wire:click="nextPage" rel="next">
                        <i class="fa fa-arrow-right"></i>
                    </button>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link"><i class="fa fa-arrow-right"></i></span>
                </li>
            @endif
        </ul>
    </nav>
</div>
<div class="float-start">
    <p class="text-sm text-gray-700 leading-5">
        {!! __('Showing') !!}
        @if ($paginator->firstItem())
            <span class="font-medium">{{ $paginator->firstItem() }}</span>
            {!! __('to') !!}
            <span class="font-medium">{{ $paginator->lastItem() }}</span>
        @else
            {{ $paginator->count() }}
        @endif
        {!! __('of') !!}
        <span class="font-medium">{{ $paginator->total() }}</span>
        {!! __('results') !!}
    </p>
</div>
@endif
