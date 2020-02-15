<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        {!! SEO::generate(true) !!}
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="{{ asset('/static/eventoutlet/dist/css/style.bundle.css') }}">
        <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
    </head>
    <body class="Site">
    <!-- main wrapper -->
    <div class="wrapper" id="app">
        <nav id="menuBody" class="navbar-general">
            <div class="container container-bg">
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
                                    <li><a href="#">Каталог специалистов</a></li>
                                    <li><a href="#">Стать исполнителем</a></li>
                                </ul>
                                <div class="navbar-general__profile">
                                    @guest
                                    <auth-form
                                    ></auth-form>
                                    @endguest
                                    @auth
                                        <div class="navbar-general__profile">
                                            <div class="navbar-general__profile-body">
                                                <div class="navbar-general__profile-preview">
                                                    <span>{{ Auth::user()->name??Auth::user()->email }}</span>
                                                    <div class="navbar-general__profile-photo"
                                                         style="background-image:url({{ Imager::avatar(Auth::user()->avatar) }})"></div>
                                                    <div class="arrow-svg"></div>
                                                </div>
                                                <ul class="navbar-general__profile-menu">
                                                    <li><a href="{{ route('site.lk.profiles.show', Auth::user()->id) }}">Личный кабинет</a></li>
                                                    <li><a href="{{ route('site.lk.profiles.edit', Auth::user()->id) }}">Редактировать профиль</a></li>
                                                    <li><a href="{{ route('logout') }}">Выход</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    @endauth
                                </div>
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
        <footer class="footer">

            <div class="container">
              <div class="row">
                <div class="col-xl-12">
                  <div class="footer__logo">
                    <img src="./img/general/logo.png" alt="">
                    <span class="eventoutlet">EventOutlet</span>
                  </div>
                </div>
              </div>
              
              <div class="row">
                <div class="col-md-6 col-xl-7">
                  <div class="footer__discription">
                    <p>
                      Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, 
                      leo eget bibendum sodales, augue velit cursus nunc.Donec sodales sagittis magna. Sed 
                      consequat, leo eget bibendum sodales, augue velit cursus nunc Sed fringilla mauris sit
                      amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue
                    </p>
                  </div>
                </div>
                <div class="col-md-6 col-xl-5">
                  <div class="footer-nav">
                    <div class="footer-nav__item">
                      <ul>
                        <li><a href="#">Главная</a></li>
                        <li><a href="#">Каталог специалистов</a></li>
                        <li><a href="#">Стать исполнителем</a></li>
                      </ul>
                    </div>
                    <div class="footer-nav__item">
                      <ul>
                        <li><a href="#">Вход</a></li>
                        <li><a href="#">Регистрация</a></li>
                        <li><a href="#">Как пользоваться?</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </footer>
    </div>
    </body>
    <script src="{{ asset('static/eventoutlet/dist/assets/js/app.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
</html>

