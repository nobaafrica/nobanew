<div>
    @if ($paginator->hasPages())
    <div class="row">
        <div class="col-lg-12">
            <ul class="pagination pagination-rounded justify-content-center mt-3 mb-4 pb-1">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                <li class="page-item disabled">
                    <a href="javascript: void(0);" class="page-link"><i class="mdi mdi-chevron-left"></i></a>
                </li>
                @else
                <li class="page-item">
                    <a role="button" wire:click="previousPage" wire:loading.attr="disabled" rel="prev" class="page-link"><i class="mdi mdi-chevron-left"></i></a>
                </li>
                @endif
                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <li class="page-item disabled">
                            <a href="javascript: void(0);" class="page-link">{{ $element }}</a>
                        </li>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="page-item active" aria-current="page" wire:key="paginator-page-{{ $page }}">
                                    <a href="javascript: void(0);" class="page-link">{{ $page }}</a>
                                </li>
                            @else
                                <li class="page-item" wire:key="paginator-page-{{ $page }}">
                                    <a role="button" class="page-link" wire:click="gotoPage({{ $page }})">{{ $page }}</a>
                                </li>
                            @endif
                        @endforeach
                    @endif
                @endforeach
                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li class="page-item">
                        <a role="button" dusk="nextPage" class="page-link" wire:click="nextPage" wire:loading.attr="disabled" rel="next"><i class="mdi mdi-chevron-right"></i></a>
                    </li>
                @else
                    <li class="page-item disabled" aria-disabled="true">
                        <a href="javascript: void(0);" class="page-link" aria-hidden="true"><i class="mdi mdi-chevron-right"></i></a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
    @endif
</div>