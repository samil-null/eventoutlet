@extends('site.layout.index')

@section('content')
    <div class="container">
        <div class="row">
            <filter-app></filter-app>
        </div>
    </div>
    <section class="catalog">
        <div class="catalog-nav"></div>
        <div class="catalog__wrapper">
            <div class="container">
                <div class="row">
                    @foreach($users as $user)
                        <div class="col-xl-12">
                            <div class="catalog-card">
                                <div class="catalog-card__head">
                                    <a href="{{ route('site.users.show', $user->id) }}">
                                        <div class="catalog-card__head-photo" style="background-image: url({{ Imager::avatar($user->avatar) }});">

                                        </div>
                                    </a>
                                    <div class="catalog-card__head-info">
                                        <a href="{{ route('site.users.show', $user->id) }}">{{ $user->name }}</a>
                                        <span>{{ $user->speciality->name }}</span>
                                    </div>
                                    <div class="catalog-card__head-info">
                                        <span>{{ $user->info->instagram }}</span>
                                        <span>Instagram</span>
                                    </div>
                                    <div class="catalog-card__head-info">
                                        <span>Цена со скидкой</span>
                                        <span class="catalog-card__head-info-price">3 000 р / час</span>
                                    </div>
                                    <div class="catalog-card__head-info-discount">
                                        <div class="catalog-card__discount-icon">
                                            <div class="percent-svg"></div>
                                        </div>
                                        <div class="catalog-card__discount-info">
                                            <span>Скидка: 30%</span>
                                            <span><a href="#">Все скидки</a></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="catalog-card__media">
                                    <div class="glide">
                                        <div class="glide__track" data-glide-el="track">
                                            <ul class="glide__slides">
                                                @foreach($user->gallery as $image)
                                                    <li class="glide__slide" >
                                                        <div class="glide__slide-bg" ></div>
                                                        <div class="glide__slide-search" data-caption="" data-bp="{{ Imager::gallery($image->name) }}">
                                                            <div class="search-svg"></div>
                                                        </div>
                                                        <div class="glide__slide__item" style="background-image: url({{ Imager::gallery($image->name) }});"></div>
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
                                    @if($user->info->email)
                                    <div class="contacts-block__item">
                                        <a href="mailto:{{ $user->info->email }}">
                                            <div class="at-svg contacts-block-svg"></div>
                                        </a>
                                    </div>
                                    @endif
                                    @if($user->info->whatsapp)
                                    <div class="contacts-block__item">
                                        <a target="_blank" href="https://api.whatsapp.com/send?phone={{ $user->info->whatsapp }}">
                                            <div class="wa-svg contacts-block-svg"></div>
                                        </a>
                                    </div>
                                    @endif
                                    @if($user->info->phone)
                                        <div class="contacts-block__item">
                                            <a href="tel:{{ $user->info->phone }}">
                                                <div class="phone-svg contacts-block-svg"></div>
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
