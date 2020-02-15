@extends('site.layout.index')

@section('content')
<section class="catalog">
    <form action="{{ route('site.offers.index') }}" id="offers-filter">
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
                            <div class="catalog-filter__wrapper"  >
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
                                            :to-range="70"
                                            value-from="{{ $filters['discount']['from'] }}"
                                            value-to="{{ $filters['discount']['to'] }}"
                                            form="#offers-filter"
                                            input-name="discount"
                                            title="Размер скидки"
                                        ></filter-range-slider>
                                    </div>
                                @endif
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
                <div class="col-md-10 col-lg-10 col-xl-10">
                    <div class="additional_filters__wrapper">
                        <div class="how-much-filters">
                            <div class="how-much-filters__wrapper">
                                <div class="how-much-filters__main">
                                    <ul>
                                        <li>
                                            <label>
                                                <input type="radio" name="per_page" value="10" />10 предложений
                                            </label>
                                        </li>
                                        <li>
                                            <label>
                                                <input type="radio" name="per_page" value="20" />20 предложений
                                            </label>
                                        </li>
                                        <li>
                                            <label>
                                                <input type="radio" name="per_page" value="30" />30 предложений
                                            </label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="additional_filters__main">
                            @foreach($filters['additional_fields'] as $field)
                            <div class="additional_filters__item addition-field">
                                    <addition-field
                                        title="{{ $field->name }}"
                                        form="#offers-filter"
                                        field-name="additional_fields[{{ $field->id }}]"
                                        value="30"
                                    />
                                    <filter-range-slider
                                        v-if="false"
                                        from-range="{{ $field->min_value }}"
                                        to-range="{{ $field->max_value }}"
                                        value-from="{{ $filters['additional_fields_params'][$field->id]['from'] }}"
                                        value-to="{{ $filters['additional_fields_params'][$field->id]['to'] }}"
                                        form="#offers-filter"
                                        input-name="additional_fields[{{ $field->id }}]"
                                        title="{{ $field->name }}"
                                        :display-result="false"
                                    ></filter-range-slider>
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
</section>
@endsection
