<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        {!! SEO::generate(true) !!}
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="apple-touch-icon" sizes="57x57" href="/favicons/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="/favicons/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="/favicons/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="/favicons/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="/favicons/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="/favicons/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="/favicons/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="/favicons/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="/favicons/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicons/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="/favicons/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicons/favicon-16x16.png">
        <!-- cms -->
        <meta name="cmsmagazine" content="5bc7fad9cf9490135a12643e10ddda0f" />
        <link rel="manifest" href="/favicons/manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="/favicons/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">
       <link rel="stylesheet" href="{{ asset('/static/eventoutlet/dist/css/style.bundle.css') }}?global={{ env('CSS_VERSION') }}&local=1">
       <link rel="stylesheet" href="{{ asset('/css/app.css') }}?global={{ env('CSS_VERSION') }}&local=1">
    </head>
    <body class="Site">
    <!-- main wrapper -->
    <div class="wrapper" id="app">
        <nav id="menuBody" class="navbar-general">
            <div class="container @if (\Route::current() && \Route::current()->getName() == 'site.home') container-bg @endif">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="navbar-general__row">
                            <a href="{{ route('site.home') }}" class="navbar-logo">
                                <img src="/static/eventoutlet/dist/img/general/logo.png" alt="">
                                <span class="eventoutlet">
							                  	EventOutlet
							                  </span>
                            </a>
                            <div class="navbar-general__collapse">
                                <ul class="navbar-general__main">
                                    <li><a href="{{ route('site.offers.index') }}">Каталог специалистов</a></li>
                                    @if(false)
                                    <li><a href="#" class="open-register-modal">Стать исполнителем</a></li>
                                    @endif
                                </ul>
                                <div class="search-block">
                                    <form action="{{ route('site.offers.index') }}">
                                        <label class="search-block__label" for="input-search">
                                            <input name="search" id="input-search" type="search" placeholder="Имя или название">
                                            <div class="search-svg"></div>
                                        </label>
                                    </form>
                                </div>
                                <div class="navbar-general__profile">

                                    @auth
                                        <div class="navbar-general__profile">
                                            <div class="navbar-general__profile-body">
                                                <div class="navbar-general__profile-preview">
                                                    <a href="{{ route('site.lk.profile.show') }}" class="profile-preview__link">{{ Auth::user()->name??Auth::user()->email }}</a>
                                                    <div class="navbar-general__profile-photo"
                                                         style="background-image:url({{ Imager::avatar(Auth::user()->avatar) }})"></div>
                                                    <div class="arrow-svg"></div>
                                                </div>
                                                <ul class="navbar-general__profile-menu">
                                                    <li><a href="{{ route('site.lk.profile.show') }}">Личный кабинет</a></li>
                                                    <li><a href="{{ route('site.lk.profile.edit') }}">Редактировать профиль</a></li>
                                                    <li><a href="{{ route('logout') }}">Выход</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    @endauth
                                </div>
                                @guest
                                <auth-form
                                ></auth-form>
                                @endguest
                            </div>
                            <div id="menuBtn" class="navbar-burger">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </nav>

        <!-- main wrapper -->
        <div class="wrapper">
            @yield('content')

        </div>
        <feedback></feedback>
        <oferta></oferta>
        <footer class="footer">

            <div class="container">
              <div class="row">
                <div class="col-xl-12">
                  <div class="footer__logo">
                    <img src="/static/eventoutlet/dist/img/general/logo.png" alt="">
                    <span class="eventoutlet">EventOutlet</span>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="footer__discription">
                    <p>
                      © 2020 Event Outlet – информационный портал по поиску исполнителей на мероприятия.
                    </p>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="footer-nav">
                    <div class="footer-nav__item">
                      <ul>
                        <li><a href="{{ route('site.home') }}">Главная</a></li>
                        <li><a href="#" class="feedback-open-trigger">Обратная связь</a></li>
                        <li><a href="#" class="oferta-open-trigger">Оферта</a></li>
                          <li><a href="{{ route('site.process') }}">Как работает портал</a></li>
                      </ul>
                    </div>

                  </div>
                </div>
              </div>
            </div>
          </footer>
    </div>

    </body>
    @stack('scripts')
</html>

