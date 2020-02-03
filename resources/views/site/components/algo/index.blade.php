<div class="col-xl-12">
    <div class="catalog-card">
        <div class="catalog-card__head">
            <div class="catalog-card__head-photo" style="background-image: url({{ Imager::avatar($user->avatar) }});">

            </div>
            <div class="catalog-card__head-info">
                <a href="{{ route('site.users.show', $user->id) }}">{{ $user->name }}</a>
                <span>{{ $user->speciality }}</span>
            </div>
            <div class="catalog-card__head-info">
                <span>{{ $user->info->instagram }}</span>
                <span>Instagram</span>
            </div>
            <div class="catalog-card__head-info">
                @if($user->isSpecials)
                    <span>Цена со скидкой</span>
                    <span class="catalog-card__head-info-price">{{ $user->offer->discount_price }} {{ $user->offer->price_option }}</span>
                @else
                    <span>Цена</span>
                    <span class="catalog-card__head-info-price">{{ $user->service_price }} {{ $user->offer->price_option }}</span>
                @endif
            </div>
            @if($user->offer->discount_price)
                <div class="catalog-card__head-info-discount">
                <div class="catalog-card__discount-icon">
                    <div class="percent-svg"></div>
                </div>
                <div class="catalog-card__discount-info">
                    @if($user->isSpecials)
                        <span>Скидка: {{ $user->offer->discount }}%</span>
                    @endif
                    <span><a href="{{ route('site.users.show', $user->id) }}">Все скидки</a></span>
                </div>
            </div>
            @endif
        </div>

        <div class="catalog-card__media">
            <div class="glide algo-media">
                <div class="glide__track" data-glide-el="track">
                    <ul class="glide__slides algo-media__slider">
                        @foreach($user->gallery as $image)
                            <li class="glide__slide">
                                <div class="glide__slide-bg"></div>
                                <div class="glide__slide-search" data-bp="{{ Imager::gallery($image['name']) }}">
                                    <div class="search-svg"></div>
                                </div>
                                <div class="glide__slide__item" style="background-image: url({{ Imager::gallery($image['name']) }});"></div>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="glide__arrows">
                    <div class="glide__left" data-glide-el="controls">
                        <button class="glide__arrow glide__arrow--prev algo-media__prev-slide" data-glide-dir="<">
                            <span class="strelka-svg"></span>
                        </button>
                    </div>
                    <div class="glide__right" data-glide-el="controls">
                        <button class="glide__arrow glide__arrow--next algo-media__next-slide" data-glide-dir=">">
                            <span class="strelka-svg"></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="catalog-card__contacts-block">
            @if(isset($user->info->email))
                <div class="contacts-block__item">
                    <a href="mailto:{{ $user->info->email }}">
                        <div class="at-svg contacts-block-svg"></div>
                    </a>
                </div>
            @endif
            @if(isset($user->info->whatsapp))
                <div class="contacts-block__item">
                    <a href="https://wa.me/{{ $user->info->whatsapp }}">
                        <div class="wa-svg contacts-block-svg"></div>
                    </a>
                </div>
            @endif

            @if(isset($user->info->phone))
                <div class="contacts-block__item">
                    <a href="tel:{{ $user->info->phone }}">
                        <div class="phone-svg contacts-block-svg"></div>
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
