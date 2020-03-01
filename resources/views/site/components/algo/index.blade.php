<div class="col-xl-12">
    <div class="catalog-card">
        <div class="catalog-card__head">
            <div class="catalog-card__head-photo" style="background-image: url({{ Imager::avatar($user->avatar, 'middle') }});"></div>
            <div class="catalog-card__head-info catalog-card-name">
                <span class="catalog-card__first-title">
                    <a href="{{ route('site.users.show', $user->id) }}">{{ $user->name }}</a>
                </span>
                <span class="catalog-card__second-title">{{ $user->speciality }}</span>
            </div>
            @if($user->info->instagram)
            <div class="catalog-card__head-info catalog-card-insta">
                <span class="catalog-card__first-title">{{ $user->info->instagram }}</span>
                <span class="catalog-card__second-title">Instagram</span>
            </div>
            @endif
            @if($user->isSpecials || $user->offer->discount_price)
                <div class="catalog-card__head-info catalog-card-price">
                    <span class="catalog-card__first-title">Цена со скидкой</span>
                    <div class="catalog-card__price">
                        <span class="catalog-card__second-title">{{ $user->offer->discount_price }} {{ $user->offer->price_option }}</span>
                    </div>
                </div>
            @else
                <div class="catalog-card__head-info catalog-card-price">
                    <span class="catalog-card__first-title">Цена</span>
                    <div class="catalog-card__price">
                        <span class="catalog-card__second-title">{{ $user->service_price }} {{ $user->offer->price_option }}</span>
                    </div>
                </div>
            @endif
            @if($user->offer->discount_price)
                <div class="catalog-card__head-info-discount">
                    <div class="catalog-card__discount-icon">
                        <div class="percent-svg"></div>
                    </div>
                    @if($user->isSpecials)
                        <div class="catalog-card__discount-info">
                            <span>Скидка: {{ $user->offer->discount }}%</span>
                            <span><a href="{{ route('site.users.show', $user->id) }}">Все скидки</a></span>
                        </div>
                    @endif
                </div>
            @endif
        </div>
        <div class="catalog-card__media algo-media">
            <div class="glide">
                <div class="glide__track" data-glide-el="track">
                    <ul class="glide__slides algo-media__slider">
                        @foreach($user->gallery as $image)
                            <li class="glide__slide">
                                <div class="glide__slide-bg"></div>
                                <div class="glide__slide-search" data-bp="{{ Imager::galleryOriginal($image['name']) }}">
                                    <div class="search-svg"></div>
                                </div>
                                <div class="glide__slide__item" style="background-image: url({{ Imager::galleryPreview($image['name']) }});"></div>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="glide__arrows">
                    <div class="glide__left" data-glide-el="controls">
                        <button class="glide__arrow glide__arrow--prev algo-media__prev-slide">
                            <span class="strelka-svg"></span>
                        </button>
                    </div>
                    <div class="glide__right" data-glide-el="controls">
                        <button class="glide__arrow glide__arrow--next algo-media__next-slide">
                            <span class="strelka-svg"></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="catalog-card__contacts-block" >
            @if($user->info->instagram)
                <div class="catalog-card__head-info catalog-card-insta">
                    <span class="catalog-card__first-title">{{ $user->info->instagram }}</span>
                    <span class="catalog-card__second-title">Instagram</span>
                </div>
            @endif

            <div class="contacts-block__item">
                <a href="#"><div class="at-svg contacts-block-svg"></div> </a>
            </div>
            <div class="contacts-block__item">
                <a href="#"> <div class="wa-svg contacts-block-svg"></div> </a>
            </div>
            <div class="contacts-block__item">
                <a href="#"> <div class="phone-svg contacts-block-svg"></div> </a>
            </div>
        </div>
    </div>
</div>
