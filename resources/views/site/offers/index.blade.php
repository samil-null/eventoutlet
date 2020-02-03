@extends('site.layout.index')

@section('content')
    <section class="catalog">
        <div class="catalog-nav" id="catalog-nav">
            <div class="catalog-nav__first">
                <div class="container">
                    <div class="row no-gutters">
                        <div class="col-12 col-xl-2">
                            <div class="catalog-nav__title">
                                <span>Каталог</span>
                            </div>
                        </div>
                        <div class="col-12 col-xl-9">
                            <div class="catalog-filter__preview">
                                <div class="catalog-filter__preview-title">
                                    <span>Фильтры специалистов</span>
                                    <div class="filter-svg"></div>
                                </div>
                            </div>
                            <div class="catalog-filter">
                                <form class="catalog-filter__wrapper"  action="{{ route('site.offers.index') }}" id="offers-filter">
                                    <button type="submit" style="display: none"  id="offers-filter-submit"></button>
                                    <div class="catalog-filter__control">
                                        <span>Фильтры поиска</span>
                                        <div class="times-svg"></div>
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
                                                :options="{{ $filters['specialities']['options'] }}"
                                                input-name="speciality_id"
                                                form="#offers-filter"
                                                active="{{ $filters['specialities']['active'] }}"
                                            ></filter-select>
                                        </div>
                                    @endif
                                    @if(in_array('date',$filters['availableFilters']))
                                        <div class="catalog-filter__item">
                                            <div class="catalog-select">
                                                <filter-date-picker
                                                    date-from="{{ $filters['dates']['from'] }}"
                                                    date-to="{{ $filters['dates']['to'] }}"
                                                    date-to-text="{{  $filters['dates']['to_date_filter'] }}"
                                                    form="#offers-filter"
                                                    max-date="{{ $filters['dates']['max_date'] }}"
                                                    min-date="{{ $filters['dates']['min_date'] }}"
                                                ></filter-date-picker>
                                            </div>
                                        </div>
                                    @endif
                                    @if(in_array('discount',$filters['availableFilters']))
                                        <div class="catalog-filter__item">
                                            <filter-range-slider
                                                from-range="{{ $filters['discount']['from'] }}"
                                                to-range="{{ $filters['discount']['to'] }}"
                                                form="#offers-filter"
                                            ></filter-range-slider>
                                        </div>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="catalog__wrapper">
            <div class="container">
                <div class="row">
                    @foreach($users as $user)
                        @include('site.components.algo.index', ['user' => $user])
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
