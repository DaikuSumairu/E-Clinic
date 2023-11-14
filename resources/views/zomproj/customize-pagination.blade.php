<!-- Customize button for paginator -->
<div class="pagination float-right">
    @if ($paginator->hasPages())
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
        <a href="#" class="btn btn-secondary btn-sm disabled" tabindex="-1" role="button" aria-disabled="true"><</a>
        @else
        <a href="{{ $paginator->previousPageUrl() }}" class="btn btn-primary btn-sm active" rel="previous" aria-pressed="true"><</a>
        @endif

        {{-- Current Page Number --}}
        <span class="mx-3">{{ $paginator->currentPage() }}</span>

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="btn btn-primary btn-sm active" rel="next" aria-pressed="true">></a>
        @else
            <a href="#" class="btn btn-secondary btn-sm disabled" tabindex="-1" role="button" aria-disabled="true">></a>
        @endif
    @endif
</div>