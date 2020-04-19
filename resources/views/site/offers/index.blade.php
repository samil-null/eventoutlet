@extends('site.layout.index')

@section('content')
<section class="catalog">
    <form action="{{ route('site.offers.index') }}" id="offers-filter">
    <div class="catalog-nav" id="catalog-nav">
        <div class="catalog-nav__first">
            <div class="container">
                <div class="row no-gutters">
                    <div class="col-12 d-md-none d-lg-block col-lg-1 col-xl-2">
                        <div class="catalog-nav__title">
                            <span>Каталог</span>
                        </div>
                    </div>
                    <div class="col-12 col-md-12 col-lg-11 col-xl-9">
                        <div class="catalog-filter__preview">
                            <div class="catalog-filter__preview-title">
                                <span>Фильтры специалистов</span>
                                <div class="filter-svg"></div>
                            </div>
                        </div>
                        <div class="catalog-filter">
                            <div class="catalog-filter__wrapper"  >
                                <button type="submit" style="display: none"  id="offers-filter-submit"></button>
                                <div class="catalog-filter__control">
                                    <span>Фильтры поиска</span>
                                    <div id="close-mobile-filter" class="times-svg"></div>
                                </div>
                                @if(in_array('city',$filters['availableFilters']))
                                    <div class="catalog-filter__item">
                                        <filter-select
                                            select-name="Город"
                                            select-title="Выберете город"
                                            :options="{{ $filters['cities']['options'] }}"
                                            input-name="city_id"
                                            form="#offers-filter"
                                            active="{{ $filters['cities']['active'] }}"
                                        ></filter-select>
                                    </div>
                                @endif
                                @if(in_array('speciality',$filters['availableFilters']))
                                    <div class="catalog-filter__item">
                                        <filter-select
                                            select-name="Специальность"
                                            select-title="Выберете специальность"
                                            :remove-additional-fields="true"
                                            :options="{{ $filters['specialities']['options'] }}"
                                            input-name="speciality_id"
                                            form="#offers-filter"
                                            active="{{ $filters['specialities']['active'] }}"
                                        ></filter-select>
                                    </div>
                                @endif
                                @if(in_array('date',$filters['availableFilters']))
                                    <div class="catalog-filter__item addition-field">
                                        <filter-date-picker
                                            date-from="{{ $filters['dates']['from'] }}"
                                            date-to="{{ $filters['dates']['to'] }}"
                                            date-to-text="{{  $filters['dates']['to_date_filter'] }}"
                                            form="#offers-filter"
                                            max-date="{{ $filters['dates']['max_date'] }}"
                                            min-date="{{ $filters['dates']['min_date'] }}"
                                        ></filter-date-picker>
                                    </div>
                                @endif
                                @if(in_array('discount',$filters['availableFilters']))
                                    <div class="catalog-filter__item addition-field">
                                        <filter-range-slider
                                            :from-range="10"
                                            :to-range="50"
                                            value-from="{{ $filters['discount']['from'] }}"
                                            value-to="{{ $filters['discount']['to'] }}"
                                            form="#offers-filter"
                                            input-name="discount"
                                            title="Размер скидки"
                                        ></filter-range-slider>
                                    </div>
                                @endif

                                <div class="catalog-filter__item addition-field form-filter-trigger-wrapper">
                                    <div class="catalog-select__button">
                                        <a href="#" class="rectangle-btn-border rectangle-btn-border-green form-filter-trigger">
                                            <span>Применить</span>
                                        </a>
                                    </div>
                                </div>
                                {{-- <div class="catalog-filter__item addition-field">
                                    <search-in-category
                                        value="{{ request()->input('search') }}"
                                        field-name="search"
                                        form="#offers-filter"
                                    />
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="additional_filters">
        <div class="container">
            <div class="row no-gutters">
                <div class="col-md-9 col-lg-10 col-xl-10">
                    <div class="additional_filters__wrapper">
                        <div class="how-much-filters">
                            <per-page-app
                                :per-page="{{ $perPage }}"
                            />
                        </div>
                        <div class="additional_filters__main">
                            @foreach($filters['additional_fields'] as $field)
                            <div class="additional_filters__item addition-field addition-field-entity">
                                    <addition-field
                                        title="{{ $field->name }}"
                                        form="#offers-filter"
                                        field-name="additional_fields[{{ $field->id }}]"
                                        value="{{ $filters['additional_fields_params'][$field->id] }}"
                                    />
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-md-2 col-lg-2 col-xl-2">
                    <special-offer-check-box
                        has-special="{{ request()->has('specials_offers') }}"
                        date-from="{{ $filters['dates']['min_date'] }}"
                        date-to="{{ $filters['dates']['max_date'] }}"

                    ></special-offer-check-box>
                </div>
            </div>
        </div>
    </div>
    </form>
    @if ($users->count())
        <div class="catalog__wrapper">
            <div class="container">
                <div class="row">
                    @foreach($users as $user)
                        @include('site.components.algo.index', ['user' => $user])
                    @endforeach
                </div>
                {{ $pagination->links('site.components.pagination') }}
            </div>

        </div>
    @else
        <div class="catalog__nothing">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="catalog__nothing_body">
                            <div class="catalog__nothing_pic"><img src="/static/eventoutlet/dist/img/general/what.png" alt="" /></div>
                            <div class="catalog__nothing_title"><span>Ничего не найдено</span></div>
                            <div class="info-page__head_subtitle">
                                <p>Упс.... По вашему запросу ничего не найдено попробуйте снова</p>
                            </div>
                            <div class="catalog__nothing_button">
                                <a href="#" onclick="window.history.back()" class="thin-rectangle-btn rectangle-btn-border-green"><span>Вернуться назад</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

</section>
@endsection
@push('scripts')
    <script src="{{ asset('js/pages/offers.js') }}?global={{ env('JS_VERSION') }}&local=1"></script>
@endpush
