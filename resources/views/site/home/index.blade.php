@extends('site.layout.index')

@section('content')
<header class="header-hero">
    <div class="container container-bg">
      <div class="header-hero__wrapper">
        <div class="header-hero__figure"></div>
        <div class="row">
          <div class="col-xl-8 offset-xl-2">
            <div class="header-hero__title">
              <span> Поиск свободных специалистов для вашего мероприятия со скидкой </span>
            </div>
            <div class="header-hero__subtitle"><span>Найдите специалиста для проекта в 2 клика</span></div>
            <search
                :specialities="{{ $specialities }}"
            ></search>
          </div>
        </div>
      </div>
    </div>
  </header>
@endsection
