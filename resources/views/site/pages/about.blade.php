@extends('site.layout.index')

@section('content')
    <section id="info-page" class="info-page">
        <div class="container">
            <div class="row">
                <div class="col-xl-10 offset-xl-1">
                    <div class="info-page__head">
                        <div class="info-page__head_header">
						<span class="info-page__heading">
							Поиск актуальных предложений на портале Event Outlet со скидкой
						</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-8 offset-xl-2">
                    <div class="info-page__head_subtitle">
                        <p>
                            Если ваше мероприятие в ближайший 31 день, а кого-то из специалистов или площадку вы еще не нашли, наш портал поможет вам! Вы сможете найти любого подрядчика на вашу дату со скидкой от 10% до 50%.
                        </p>
                    </div>
                </div>
            </div>
            <div class="info-page__wrapper">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-6 col-xl-6 d-flex">
                        <div class="info-page__card cole">
                            <div class="info-page__card_head">
                                <img src="/static/eventoutlet/dist/img/general/what.png" alt="">
                            </div>
                            <div class="info-page__card_body">
                                <div class="info-page__card_title">
								<span class="info-page__card-heading">
									Кому нужен этот портал?
								</span>
                                </div>
                                <div class="info-page__card_subtitle">
                                    <p>
                                        Для тех кто готовится к мероприятию.
                                        Свадьба, корпоративное мероприятие, детский праздник, день рождения, бизнес-конференция и прочее
                                    </p>
                                    <p>
                                        Портал подходит как для профессионалов, так и для частных лиц
                                    </p>
                                    <p>
                                        Если вам просто нужен специалист event-индустрии на конкретный день
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-xl-6 d-">
                        <div class="info-page__card cole">
                            <div class="info-page__card_head">
                                <img src="/static/eventoutlet/dist/img/general/what-2.png" alt="">
                            </div>
                            <div class="info-page__card_body">
                                <div class="info-page__card_title">
								<span class="info-page__card-heading">
									Как это работает?
								</span>
                                </div>
                                <div class="info-page__card_subtitle">
                                    <p>
                                        Если ваше мероприятие проходит в ближайший 31 день, то вы можете получить скидку на услуги профессионалов от 10% до 50%
                                    </p>
                                    <p>
                                        Это совершенно бесплатно, вы платите только за услуги профессионалов лично им
                                    </p>
                                    <p>
                                        Актуальные предложения появляются каждый день
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-xl-6 d-">
                        <div class="info-page__card cole">
                            <div class="info-page__card_head">
                                <img src="/static/eventoutlet/dist/img/general/what-3.png" alt="">
                            </div>
                            <div class="info-page__card_body">
                                <div class="info-page__card_title">
								<span class="info-page__card-heading">
									Как найти специалиста?
								</span>
                                </div>
                                <div class="info-page__card_subtitle">
                                    <p>
                                        Выбираете вашу дату или интервал дат
                                    </p>
                                    <p>
                                        Выбираете нужных специалистов или площадку
                                    </p>
                                    <p>
                                        Начинаете поиск
                                    </p>
                                    <p>
                                        Выбираете подходящего специалиста и связываетесь с ним для дальнейшего обсуждения условий работы
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-xl-6 d-">
                        <div class="info-page__card cole">
                            <div class="info-page__card_head">
                                <img src="/static/eventoutlet/dist/img/general/what-4.png" alt="">
                            </div>
                            <div class="info-page__card_body">
                                <div class="info-page__card_title">
								<span class="info-page__card-heading">
									Что Вы получаете?
								</span>
                                </div>
                                <div class="info-page__card_subtitle">
                                    <p>
                                        Вы экономите время на поиске, так как видите всех свободных специалистов на вашу дату сразу на одном портале
                                    </p>
                                    <p>
                                        Вы видите сразу все актуальные цены и условия
                                    </p>
                                    <p>
                                        Вы экономите бюджет вашего мероприятия, так как получаете гарантированную скидку от 10% до 50%
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="whats-it__benefits_button"><a href="{{ route('site.offers.index') }}" class="benefits-btn yellow"><span>Подобрать исполнителя</span> <div class="full-arrow-svg"></div></a></div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script src="{{ asset('js/pages/home.js') }}?global={{ env('JS_VERSION') }}&local=1"></script>
@endpush
