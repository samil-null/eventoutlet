@extends('site.layout.index')

@section('content')
    <section id="profile" class="profile">
        <div class="profile-slider">
            <div class="profile-slider__wrapper">
                <div class="profile-slider__background" id="profile-slider-bg" style="background-image: url(./img/slider/o.jpg);"></div>
                <div class="profile-slider__body">
                    <div class="profile-slider__main">
                        <div class="slider-for">
                            @foreach ($user->gallery as $image)
                                <div class="profile-slider__item">
                                    <img src="{{ Imager::galleryOriginal($image->name) }}" class="" data-bg="{{ Imager::gallerySmall($image->name) }}" alt="">
                                </div>
                            @endforeach
                        </div>
                        <div class="profile-slider__controls">
                            <div class="profile-slider__prev">
                                <div class="full-arrow-svg"></div>
                            </div>
                            <div class="profile-slider__next">
                                <div class="full-arrow-svg"></div>
                            </div>
                        </div>
                    </div>
                    <div class="profile-slider__nav">
                        <div class="slider-nav">
                            @foreach ($user->gallery as $image)
                                <div class="slider-nav__canvas-item">
                                    <div class="profile-slider__nav_item" style="background-image: url({{ Imager::gallerySmall($image->name) }});"></div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="profile__wrapper">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="profile__body">
                            <div class="profile-preview">
                                <div class="profile-preview__body">
                                    <div class="profile-preview__item profile-preview__photo">
                                        <div class="profile-preview__pic" style="background-image: url({{ Imager::avatar($user->avatar) }};">
                                        </div>
                                    </div>
                                    <div class="profile-preview__item profile-preview__name">
                                        <h1>{{ $user->name }}</h1>
                                        <h2>{{ $user->speciality->name }}</h2>
                                    </div>
                                    @if ($user->info->instagram)
                                        <div class="profile-preview__item profile-preview__insta">
                                        <a href="{{ Social::instagramUrl($user->info->instagram) }}" target="_blank" >{{ Social::instagramTag($user->info->instagram) }}</a>
                                        <span>Instagram</span>
                                    </div>
                                    @endif
                                    <div class="profile-preview__item profile-preview__catacts">
                                        <div class="contacts-block__item">
                                            @if ($user->info->email)
                                                <a href="mailto:{{ $user->info->email }}">
                                                    <div class="at-svg contacts-block-svg"></div>
                                                </a>
                                            @endif
                                        </div>
                                        @if ($user->info->whatsapp)
                                            <div class="contacts-block__item">
                                                <a target="_blank" href="{{ Social::whatsappUrl($user->info->whatsapp) }}">
                                                    <div class="wa-svg contacts-block-svg"></div>
                                                </a>
                                            </div>
                                        @endif
                                        @if ($user->info->phone)
                                        <div class="contacts-block__item">
                                            <a href="tel:{{ $user->info->phone }}">
                                                <div class="phone-svg contacts-block-svg"></div>
                                            </a>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="profile-core">
                                <div class="row">
                                    <div class="col-12 col-md-12 col-lg-8 col-xl-8">
                                        <div class="profile-core__content">
                                            <div class="profile-core__intro">
                                                <div class="profile-core__title">
                                                    <span>{{ $user->speciality->name }}</span>
                                                </div>
                                                <div class="profile-core__sity">
                                                    <div class="location-svg"></div>
                                                    <span>{{ $user->city->name }}</span>
                                                </div>
                                                <div class="profile-core__subtitle">
                                                    <p>
                                                        {{ $user->info->about_me }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="profile-core__contacts">
                                                <div class="profile-core__contacts_title">
                                                    <span>Контакты</span>
                                                </div>
                                                <div class="pe-block__form form">
                                                    <form action="">
                                                        <div class="row">
                                                            @if ($user->info->phone)
                                                                <div class="col-xl-6">
                                                                    <div  class="form__label">
                                                                        <span>Телефон</span>
                                                                        <a href="tel:{{ $user->info->phone }}" class="form__icon-input-wrapper">
                                                                            <div class="phone-svg input-svg"></div>
                                                                            <div class="delimiter"></div>
                                                                            <div class="profile-core__text">{{ $user->info->phone }}</div>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                            @if($user->info->site)
                                                                <div class="col-xl-6">
                                                                    <div class="form__label">
                                                                        <span>Сайт</span>
                                                                        <a target="_blank" href="{{ Social::webSiteUrl($user->info->site) }}" class="form__icon-input-wrapper">
                                                                            <div class="exploier-svg input-svg"></div>
                                                                            <div class="delimiter"></div>
                                                                            <div class="profile-core__text">{{ $user->info->site }}</div>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                            @if($user->info->email)
                                                                <div class="col-xl-6">
                                                                    <div  class="form__label">
                                                                        <span>Email</span>
                                                                        <a href="mailto:{{ $user->info->email }}" class="form__icon-input-wrapper">
                                                                            <div class="at-svg input-svg"></div>
                                                                            <div class="delimiter"></div>
                                                                            <div class="profile-core__text">{{ $user->info->email }}</div>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                            @if ($user->info->instagram)
                                                                <div class="col-xl-6">
                                                                    <div class="form__label">
                                                                        <span>Instagram</span>
                                                                        <a target="_blank" href="{{ Social::instagramUrl($user->info->instagram) }}" class="form__icon-input-wrapper">
                                                                            <div class="inst-svg input-svg"></div>
                                                                            <div class="delimiter"></div>
                                                                            <div class="profile-core__text">{{ Social::instagramTag($user->info->instagram) }}</div>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                            @if($user->info->vk)
                                                            <div class="col-xl-6">
                                                                <div class="form__label">
                                                                    <span>Вконтакте</span>
                                                                    <a target="_blank" href="{{ Social::webSiteUrl($user->info->vk) }}" class="form__icon-input-wrapper">
                                                                        <div class="vk-svg input-svg"></div>
                                                                        <div class="delimiter"></div>
                                                                        <div class="profile-core__text">{{ $user->info->vk }}</div>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            @endif
                                                            @if($user->info->whatsapp)
                                                            <div class="col-xl-6">
                                                                <div class="form__label">
                                                                    <span>WhatsApp</span>
                                                                    <a target="_blank" href="{{ Social::whatsappUrl($user->info->whatsapp) }}" class="form__icon-input-wrapper">
                                                                        <div class="wa-svg input-svg"></div>
                                                                        <div class="delimiter"></div>
                                                                    <div class="profile-core__text">{{ $user->info->whatsapp }}</div>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            @endif
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="profile-core__contacts">
                                            <div class="profile-core__contacts_title">
                                                <span>Услуги</span>
                                            </div>
                                            
                                                @foreach($user->activeServices as $service)
                                                    <div class="profile-edit__body profile-core__list">
                                                    <!-- Line -->
                                                    <div class="pe-block pr-block">
                                                        <div class="special-offer">
                                                            <div class="special-offer__head">
                                                                <!-- <div class="special-offer__icon">
                                                                    <div class="catalog-card__discount-icon">
                                                                        <div class="percent-svg"></div>
                                                                    </div>
                                                                </div> -->
                                                                <div class="special-offer__item">
                                                                    <span>Услуга</span>
                                                                    <span>{{ $service->name }}</span>
                                                                </div>
                                                                <div class="special-offer__item profile-core__offer-item">
                                                                    <span>Стоимость</span>
                                                                    <span>{{ $service->price }} {{ $service->priceOption->name }}</span>
                                                                </div>
                                                            </div>
                                                            <div class="special-offer__desctipton">
                                                                <div class="special-offer__desctipton-title">
                                                                    <span>Описание</span>
                                                                </div>
                                                                <div class="special-offer__desctipton-body">
                                                                    <p>{{ $service->description }}.</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach

                                        </div>
                                    </div>
                                    <div class="col-12 col-md-12 col-lg-4 col-xl-4">
                                        <div class="profile-core__sidebar">
                                            <div class="sidebar__item">
                                                <div class="sidebar__title">
                                                    <span>Предложения по датам</span>
                                                </div>
                                                <div class="sidebar__core">
                                                    <div class="sidebar__calendar">
                                                        <user-calendar :dates="{{ $dates }}"/>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="sidebar__title">
                                                <span>Спецпредложения</span>
                                            </div>
                                            @foreach($offers as $offer)
                                                <div class="sidebar__item">
                                                <div class="sidebar__core">
                                                    <div class="sidebar__head">
                                                        <div class="catalog-card__discount-icon">
                                                            <div class="percent-svg"></div>
                                                        </div>
                                                        <div class="sidebar__head_item">
                                                            <span>Дата</span>
                                                            <span class="sidebar-price">{{ $offer->dates }}</span>
                                                        </div>
                                                        <div class="sidebar__head_item">
                                                            <span>Услуга</span>
                                                            <span class="service-name">{{ $offer->serviceName }}</span>
                                                        </div>
                                                        <!-- <div class="sidebar__slash"></div> -->
                                                    </div>
                                                    <div class="sidebar__head">
                                                        <div class="sidebar__head_item">
                                                            <span>Скидка</span>
                                                            <span class="sidebar-price">{{ $offer->discount }}%</span>
                                                        </div>
                                                        <div class="sidebar__head_item">
                                                            <span>Цена со скидкой</span>
                                                            <span class="service-name">{{ $offer->price }} {{ $offer->priceOption }}</span>
                                                        </div>
                                                        <!-- <div class="sidebar__slash"></div> -->
                                                    </div>
                                                    <div class="sidebar__description">
                                                        <span>Описание</span>
                                                        <p>
                                                            {{ $offer->description }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script src="{{ asset('js/pages/users.js') }}"></script>
    <script src="{{ asset('js/common/algo.js') }}"></script>
@endpush
