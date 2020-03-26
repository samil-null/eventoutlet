@if ($paginator->hasPages())
    <div class="catalog-pagination">
        <div class="catalog-pagination__wrapper">
            <div class="catalog-pagination__body">
            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                        <div class="catalog-pagination__item">...</div>
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




{{--                <div class="catalog-pagination__item">3</div>--}}
{{--                <div class="catalog-pagination__item">...</div>--}}
{{--                <div class="catalog-pagination__item">98</div>--}}
            </div>
        </div>
    </div>
@endif
