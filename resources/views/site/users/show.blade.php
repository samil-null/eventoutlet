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
                                    <img src="{{ Imager::gallery($image->name) }}" class="" alt="">
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
                                    <div class="profile-slider__nav_item" style="background-image: url({{ Imager::gallery($image->name) }});"></div>
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
                                        <span>{{ $user->name }}</span>
                                        <span>{{ $user->speciality->name }}</span>
                                    </div>
                                    <div class="profile-preview__item profile-preview__insta">
                                        <span>@info_mirosch</span>
                                        <span>Instagram</span>
                                    </div>
                                    <div class="profile-preview__item profile-preview__price" style="opacity:0">
                                        <span>Цена со скидкой</span>
                                        <span>от 3 000 р / час</span>
                                    </div>
                                    <div class="profile-preview__item profile-preview__catacts">
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
                                                                    <label class="form__label">
                                                                        <span>Телефон</span>
                                                                        <div class="form__icon-input-wrapper">
                                                                            <div class="phone-svg input-svg"></div>
                                                                            <div class="delimiter"></div>
                                                                            <div class="profile-core__text">{{ $user->info->phone }}</div>
                                                                        </div>
                                                                    </label>
                                                                </div>
                                                            @endif
                                                            @if($user->info->sitea)
                                                                <div class="col-xl-6">
                                                                    <label class="form__label">
                                                                        <span>Ваш сайт</span>
                                                                        <div class="form__icon-input-wrapper">
                                                                            <div class="exploier-svg input-svg"></div>
                                                                            <div class="delimiter"></div>
                                                                            <div class="profile-core__text">{{ $user->info->site }}</div>
                                                                        </div>
                                                                    </label>
                                                                </div>
                                                            @endif
                                                            @if($user->info->email)
                                                                <div class="col-xl-6">
                                                                    <label class="form__label">
                                                                        <span>Email</span>
                                                                        <div class="form__icon-input-wrapper">
                                                                            <div class="at-svg input-svg"></div>
                                                                            <div class="delimiter"></div>
                                                                            <div class="profile-core__text">{{ $user->info->email }}</div>
                                                                        </div>
                                                                    </label>
                                                                </div>
                                                            @endif
                                                            @if ($user->info->instagram)
                                                                <div class="col-xl-6">
                                                                    <label class="form__label">
                                                                        <span>Instagram</span>
                                                                        <div class="form__icon-input-wrapper">
                                                                            <div class="inst-svg input-svg"></div>
                                                                            <div class="delimiter"></div>
                                                                            <div class="profile-core__text">{{ $user->info->email }}</div>
                                                                        </div>
                                                                    </label>
                                                                </div>
                                                            @endif
                                                            @if($user->info->vk)
                                                            <div class="col-xl-6">
                                                                <label class="form__label">
                                                                    <span>Вконтакте</span>
                                                                    <div class="form__icon-input-wrapper">
                                                                        <div class="vk-svg input-svg"></div>
                                                                        <div class="delimiter"></div>
                                                                        <div class="profile-core__text">vk.c{{ $user->info->vk }}</div>
                                                                    </div>
                                                                </label>
                                                            </div>
                                                            @endif
                                                            @if($user->info->whatsapp)
                                                            <div class="col-xl-6">
                                                                <label class="form__label">
                                                                    <span>WhatsApp</span>
                                                                    <div class="form__icon-input-wrapper">
                                                                        <div class="wa-svg input-svg"></div>
                                                                        <div class="delimiter"></div>
                                                                    <div class="profile-core__text">{{$user->info->whatsapp }}</div>
                                                                    </div>
                                                                </label>
                                                            </div>
                                                            @endif
                                                        </div>                                                    
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="profile-core__contacts">
                                            <div class="profile-core__contacts_title">
                                                <span>Спецпредложения</span>
                                            </div>
                                            <div class="profile-edit__body profile-core__list">
                                                <!-- Line -->
                                                <div class="pe-block pr-block">
                                                    <div class="special-offer">
                                                        <div class="special-offer__head">
                                                            <div class="special-offer__icon">
                                                                <div class="catalog-card__discount-icon">
                                                                    <div class="percent-svg"></div>
                                                                </div>
                                                            </div>
                                                            <div class="special-offer__item ">
                                                                <span>Дата</span>
                                                                <span>10-16.07.2019</span>
                                                            </div>
                                                            <div class="special-offer__item">
                                                                <span>Услуга</span>
                                                                <span>Фотосессия </span>
                                                            </div>
                                                            <div class="special-offer__item">
                                                                <span>Цена со скидкой</span>
                                                                <span>3 000 р / фикс</span>
                                                            </div>
                                                            <div class="special-offer__item">
                                                                <span>Скидка</span>
                                                                <span>30%</span>
                                                            </div>
                                                        </div>
                                                        <div class="special-offer__desctipton">
                                                            <div class="special-offer__desctipton-title">
                                                                <span>Описание</span>
                                                            </div>
                                                            <div class="special-offer__desctipton-body">
                                                                <p>Минимальное время работы 3 часа. В черте города. Итог до 40
                                                                    ретушированных фотографий.</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="profile-edit__body profile-core__list">
                                                <!-- Line -->
                                                <div class="pe-block pr-block">
                                                    <div class="special-offer">
                                                        <div class="special-offer__head">
                                                            <div class="special-offer__icon">
                                                                <div class="catalog-card__discount-icon">
                                                                    <div class="percent-svg"></div>
                                                                </div>
                                                            </div>
                                                            <div class="special-offer__item ">
                                                                <span>Дата</span>
                                                                <span>10-16.07.2019</span>
                                                            </div>
                                                            <div class="special-offer__item">
                                                                <span>Услуга</span>
                                                                <span>Фотосессия </span>
                                                            </div>
                                                            <div class="special-offer__item">
                                                                <span>Цена со скидкой</span>
                                                                <span>3 000 р / фикс</span>
                                                            </div>
                                                            <div class="special-offer__item">
                                                                <span>Скидка</span>
                                                                <span>30%</span>
                                                            </div>
                                                        </div>
                                                        <div class="special-offer__desctipton">
                                                            <div class="special-offer__desctipton-title">
                                                                <span>Описание</span>
                                                            </div>
                                                            <div class="special-offer__desctipton-body">
                                                                <p>Минимальное время работы 3 часа. В черте города. Итог до 40
                                                                    ретушированных фотографий.</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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
                                                        <v-calendar
                                                            class="sidebar-calendar"
                                                            mode='range' 
                                                            title-position="left"
                                                            v-model='date'
                                                            is-inline
                                                            color="red"
                                                            :popover="{ placement: 'bottom', visibility: 'click' }">
                                                        </v-calendar>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                            <div class="sidebar__title">
                                                <span>Стоимость</span>
                                            </div>
                                            <div class="sidebar__item">
                                                <div class="sidebar__core">
                                                   <div class="sidebar__head">
                                                    <div class="sidebar__head_item">
                                                        <span>Услуга</span>
                                                        <span class="service-name">Фотосессия</span>
                                                    </div>
                                                    <div class="sidebar__slash"></div>
                                                    <div class="sidebar__head_item">
                                                        <span>Стоимость</span>
                                                        <span class="sidebar-price">4 000 р / час</span>
                                                    </div>
                                                   </div>
                                                   <div class="sidebar__description">
                                                       <span>Описание</span>
                                                       <p>
                                                            Минимальное время работы 5 часа. Если свадьба загородом трансфер оплачивает заказчик.
                                                       </p>
                                                   </div>
                                                </div>
                                            </div>
    
                                            <div class="sidebar__item">
                                                <div class="sidebar__core">
                                                   <div class="sidebar__head">
                                                    <div class="sidebar__head_item">
                                                        <span>Услуга</span>
                                                        <span class="service-name">Фотосессия</span>
                                                    </div>
                                                    <div class="sidebar__slash"></div>
                                                    <div class="sidebar__head_item">
                                                        <span>Стоимость</span>
                                                        <span class="sidebar-price">4 000 р / час</span>
                                                    </div>
                                                   </div>
                                                   <div class="sidebar__description">
                                                       <span>Описание</span>
                                                       <p>
                                                            Минимальное время работы 5 часа. Если свадьба загородом трансфер оплачивает заказчик.
                                                       </p>
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
            </div>
        </div>
        </div>
    </section>
@endsection
