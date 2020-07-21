@if ($paginator->hasPages())
    <div class="catalog-pagination">
        <div class="catalog-pagination__wrapper">
            <div class="catalog-pagination__body">
            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                        <div class="catalog-pagination__item catalog-pagination__item_more">...</div>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span href="#" class="catalog-pagination__item active">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="catalog-pagination__item">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach
            </div>
        </div>
    </div>
@endif

@push('scripts')
    <style>
        @media (max-width:768px) {
            .catalog-pagination__item {
                display: none;
            }

            .catalog-pagination__item.show {
                display: flex;
            }

            .catalog-pagination__item:first-child,
            .catalog-pagination__item:last-child,
            .catalog-pagination__item.active {
                display: flex;
            }
        }
    </style>
    <script>
        if (window.innerWidth < 768) {            
            let paginationElement = document.querySelector('.catalog-pagination__item.active');
            
            if (paginationElement.nextElementSibling) {
                paginationElement.nextElementSibling.classList.add('show');
            }

            if (paginationElement.previousElementSibling) {
                paginationElement.previousElementSibling.classList.add('show');
            }
            
        }
    </script>
@endpush
