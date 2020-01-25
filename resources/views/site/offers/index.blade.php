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
                                <div class="catalog-filter__wrapper">
                                    <div class="catalog-filter__control">
                                        <span>Фильтры поиска</span>
                                        <div class="times-svg"></div>
                                    </div>
                                    <div class="catalog-filter__item">
                                        <div class="catalog-select">
                                            <div class="catalog-select__intro">
                                                <div class="catalog-select__title">
                                                    <span>Город</span>
                                                    <div class="arrow-svg"></div>
                                                </div>
                                                <div class="catalog-select__result">
                                                    <span>Москва</span>
                                                </div>
                                            </div>
                                            <div class="catalog-select__body">
                                                <div class="catalog-select__body-title">
                                                    <span>Выберете город</span>
                                                </div>
                                                <div class="form__select-wrapper">
                                                    <div class="form__select-list">
                                                        <span>Москвабад</span>
                                                        <span>Питерстан</span>
                                                        <span>Сочян</span>
                                                        <span>Краснодаридзе</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="catalog-filter__item">
                                        <div class="catalog-select">
                                            <div class="catalog-select__intro">
                                                <div class="catalog-select__title">
                                                    <span>Специальность</span>
                                                    <div class="arrow-svg"></div>
                                                </div>
                                                <div class="catalog-select__result">
                                                    <span>Фотограф</span>
                                                </div>
                                            </div>
                                            <div class="catalog-select__body">
                                                <div class="catalog-select__body-title">
                                                    <span>Выберете специальность</span>
                                                </div>
                                                <div class="form__select-wrapper">
                                                    <div class="form__select-list">
                                                        <span>Художники</span>
                                                        <span>Фотографы</span>
                                                        <span>Ведущие</span>
                                                        <span>Колористы</span>
                                                        <span>Организаторы</span>
                                                        <span>Рестораны</span>
                                                        <span>Аниматоры</span>
                                                        <span>Эвент-мейкеры</span>
                                                        <span>Хареографы</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="catalog-filter__item">
                                        <div class="catalog-select">
{{--                                            <v-calendar--}}
{{--                                                class="calendarr"--}}
{{--                                                mode='range'--}}
{{--                                                title-position="left"--}}
{{--                                                v-model='date'--}}
{{--                                                :popover="{ placement: 'bottom', visibility: 'click' }">--}}
{{--                                                <div class="catalog-select__intro">--}}


{{--                                                    <div class="catalog-select__title">--}}
{{--                                                        <span>Дата</span>--}}
{{--                                                        <div class="arrow-svg"></div>--}}
{{--                                                    </div>--}}

{{--                                                    <div class="catalog-select__result">--}}
{{--                                                        <span>Москва</span>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </v-calendar>--}}
                                            <div class="catalog-select__body">
                                                <div class="catalog-select__body-title">
                                                    <span>Выберете размер скидки</span>
                                                </div>
                                                <div class="form__select-wrapper">
                                                    <div class="form__select-list">
                                                        <span>Художники</span>
                                                        <span>Фотографы</span>
                                                        <span>Ведущие</span>
                                                        <span>Колористы</span>
                                                        <span>Организаторы</span>
                                                        <span>Рестораны</span>
                                                        <span>Аниматоры</span>
                                                        <span>Эвент-мейкеры</span>
                                                        <span>Хареографы</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="catalog-filter__item">
                                        <div class="catalog-select">
                                            <div class="catalog-select__intro">
                                                <div class="catalog-select__title">
                                                    <span>Размер скидки</span>
                                                    <div class="arrow-svg"></div>
                                                </div>
                                                <div class="catalog-select__result">
                                                    <span>Москва</span>
                                                </div>
                                            </div>
                                            <div class="catalog-select__body">
                                                <div class="catalog-select__body-title">
                                                    <span>Выберете размер скидки</span>
                                                </div>
                                                <div class="form__select-wrapper">
                                                    <div class="form__range">
                                                        <div class="range-result">
			 													<span class="rent-value">

			 													</span>
                                                        </div>
                                                        <input type="text" id="sampleSlider" />
                                                    </div>

                                                </div>
                                                <div class="catalog-select__button">
                                                    <a href="#" class="rectangle-btn-border rectangle-btn-border-green">
                                                        <span>Применить</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="catalog-filter__item">
                                        <div class="catalog-select">
                                            <div class="catalog-select__intro">
                                                <div class="catalog-select__title">
                                                    <span>Дата</span>
                                                    <div class="arrow-svg"></div>
                                                </div>
                                                <div class="catalog-select__result">
                                                    <span>Москва</span>
                                                </div>
                                            </div>
                                            <div class="catalog-select__body">
                                                huemoe
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
                        <div class="col-xl-12">
                            <div class="catalog-card">
                                <div class="catalog-card__head">
                                    <a class="catalog-card__head-photo" style="background-image: url({{ Imager::avatar($user->avatar) }});">

                                    </a>
                                    <div class="catalog-card__head-info">
                                        <a href="{{ route('site.users.show', $user->id) }}">{{ $user->name }}</a>
                                        <span>{{ $user->speciality }}</span>
                                    </div>
                                    <div class="catalog-card__head-info">
                                        <span>{{ $user->info->instagram }}</span>
                                        <span>Instagram</span>
                                    </div>
                                    <div class="catalog-card__head-info">
                                        <span>Цена со скидкой</span>
                                        <span class="catalog-card__head-info-price">{{ $user->offer->discount_price }} р / час</span>
                                    </div>
                                    <div class="catalog-card__head-info-discount">
                                        <div class="catalog-card__discount-icon">
                                            <div class="percent-svg"></div>
                                        </div>
                                        <div class="catalog-card__discount-info">
                                            <span>Скидка: {{ $user->offer->discount }}%</span>
                                            <span><a href="{{ route('site.users.show', $user->id) }}">Все скидки</a></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="catalog-card__media">
                                    <div class="glide">
                                        <div class="glide__track" data-glide-el="track">
                                            <ul class="glide__slides">
                                                @foreach($user->gallery as $image)
                                                    <li class="glide__slide">
                                                        <div class="glide__slide-bg"></div>
                                                        <div class="glide__slide-search">
                                                            <div class="search-svg"></div>
                                                        </div>
                                                        <div class="glide__slide__item" style="background-image: url({{ Imager::gallery($image['name']) }});"></div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <div class="glide__arrows">
                                            <div class="glide__left" data-glide-el="controls">
                                                <button class="glide__arrow glide__arrow--prev" data-glide-dir="<">
                                                    <span class="strelka-svg"></span>
                                                </button>
                                            </div>
                                            <div class="glide__right" data-glide-el="controls">
                                                <button class="glide__arrow glide__arrow--next" data-glide-dir=">">
                                                    <span class="strelka-svg"></span>
                                                </button>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="catalog-card__contacts-block">
                                    <div class="contacts-block__item">
                                        <a href="#">
                                            <div class="at-svg contacts-block-svg"></div>
                                        </a>
                                    </div>
                                    <div class="contacts-block__item">
                                        <a href="#">
                                            <div class="wa-svg contacts-block-svg"></div>
                                        </a>
                                    </div>
                                    <div class="contacts-block__item">
                                        <a href="#">
                                            <div class="phone-svg contacts-block-svg"></div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
