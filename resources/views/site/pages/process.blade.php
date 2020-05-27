@extends('site.layout.index')

@section('content')
<header class="header-hero progress-hero">
	<div class="container container-bg">
		<div class="header-hero__wrapper">
			<div class="header-hero__figure"></div>
			<div class="row">
				<div class="col-12 col-sm-12 col-md-10 col-xl-8 offset-md-1 offset-xl-2"><!-- html change -->
					<div class="header-hero__title">
						<span>
							Поиск свободных специалистов для мероприятия со скидкой
						</span>
					</div>
					<div class="header-hero__subtitle">
						<span>Станьте исполнителем на EventOutlet и клиенты найдут вас сами!</span>
					</div>
				</div>
			</div>
			<!-- html change -->
			@guest
			<div class="header-hero__independent">
				<button type="button" class="almost-square-btn almost-square-btn-corral open-register-modal">
					<span>Стать исполнителем</span>
				</button>
			</div>
			@endguest
		</div>
	</div>
</header>
<section id="whats" class="whats">
	<div class="container">
		<div class="row">
			<div class="progress__title-block">
				<span class="progress__title">
					Event Outlet это портал, который <b>помогает</b> сделать работу еще более продуктивной, <b>увеличить запись</b> на месяц вперед <b>и не простаивать</b>. 
				</span>
			</div>
		</div>
					
			
			<div class="whats-it__count progress__cards">
				<div class="row">
					<!-- Item -->
					<div class="col-12 col-sm-6 col-md-6 col-lg-3 col-xl-3 d-flex">
						<div class="whats-it__block">
							<div class="whats-it__block_wrapp">
								<div class="whats-it__block_pic">
									<img src="/static/eventoutlet/dist/img/general/process.png" alt="">
								</div>
								<div class="whats-it__block_title">
									<span>Экономия рекламного бюджета</span>
								</div>
								<div class="whats-it__block_subtitle">
									<p>
										Event Outlet связывает вас с клиентом, который ищет специалиста на конкретную дату. Вам не нужно тратить деньги на контекстную рекламу и социальные сети.
									</p>
								</div>
							</div>
						</div>
					</div>
					<!-- Item -->
					<div class="col-12 col-sm-6 col-md-6 col-lg-3 col-xl-3 d-flex">
						<div class="whats-it__block">
							<div class="whats-it__block_wrapp">
								<div class="whats-it__block_pic">
									<img src="/static/eventoutlet/dist/img/general/process2.png" alt="">
								</div>
								<div class="whats-it__block_title">
									<span>Экономия времени</span>
								</div>
								<div class="whats-it__block_subtitle">
									<p>
										2 клика, и ваше спецпредложение уже размещено. Не надо создавать дизайн и текст рекламной коммуникации.
									</p>
								</div>
								
							</div>
						</div>
					</div>
					<!-- Item -->
					<div class="col-12 col-sm-6 col-md-6 col-lg-3 col-xl-3 d-flex">
						<div class="whats-it__block">
							<div class="whats-it__block_wrapp">
								<div class="whats-it__block_pic">
									<img src="/static/eventoutlet/dist/img/general/process3.png" alt="">
								</div>
								<div class="whats-it__block_title">
									<span>Целевая аудитория</span>
								</div>
								<div class="whats-it__block_subtitle">
									<p>
										Ваше спецпредложение направлено только на целевых клиентов. А также, вы всегда есть в открытом каталоге , где вас могут выбрать по хорошему портфолио на любую дату.
									</p>
								</div>
							</div>
						</div>
					</div>
					<!-- Item -->
					<div class="col-12 col-sm-6 col-md-6 col-lg-3 col-xl-3 d-flex">
						<div class="whats-it__block">
							<div class="whats-it__block_wrapp">
								<div class="whats-it__block_pic">
									<img src="/static/eventoutlet/dist/img/general/process4.png" alt="">
								</div>
								<div class="whats-it__block_title">
									<span>Никаких посредников</span>
								</div>
								<div class="whats-it__block_subtitle">
									<p>
										Мы не берем агентскую комиссию. Все расчеты и переговоры вы ведете напрямую с клиентом. 
									</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>	
			@guest
			<div class="whats-it__benefits_button process__button">
				<button class="benefits-btn yellow open-register-modal">
					<span>Стать исполнителем</span> 
					<div class="full-arrow-svg"></div>
				</button>
			</div>
			@endguest
		</div>
	</div>
</section>
<section id="process-punkts" class="process-punkts">
	<div class="container">
		<div class="row">
			<div class="process-punkts__card">
				<span>Добавьте на портал свои свободные даты в ближайший 31 день</span>
				<div class="process-punkts__number">
					<span>01</span>
				</div>
			</div>
			<div class="process-punkts__card">
				<span>Дайте на них скидку от 10% до 50%, на своих условиях</span>
				<div class="process-punkts__number">
					<span>02</span>
				</div>
			</div>
			<div class="process-punkts__card">
				<span>Клиент находит вас и сам звонит или пишет в WhatsApp</span>
				<div class="process-punkts__number">
					<span>03</span>
				</div>
			</div>
			<div class="process-punkts__card">
				<span>Done! Пустых дней в этом месяце все меньше, работы все больше!</span>
				<div class="process-punkts__number">
					<span>04</span>
				</div>
			</div>
			
		</div>
	</div>
</section>
<section id="profitable" class="profitable profitable-process">
	<div class="profitable__f-figure" style="background-image: url(/static/eventoutlet/dist/img/general/evd-item.png);"></div>
	<div class="profitable__s-figure" style="background-image: url(/static/eventoutlet/dist/img/general/evd-s-item.png);"></div>
	<div class="container">
		<div class="profitable__head">
			<div class="row">
				<div class="col-12 col-sm-10 offset-sm-1 col-md-10 offset-md-1 col-lg-8 offset-lg-2 col-xl-10 offset-xl-1"><!-- Html changes -->
					<div class="whats-it__title">
						<span>Почему только ближайший 31 день? </span>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-12 col-sm-12 col-md-8 offset-md-2 col-lg-8 col-xl-6 offset-xl-3">
					<div class="whats-it__subtitle">
						<p>
							Мы не видим смысла всегда работать со скидкой, тем самым обесценивая свой труд. Но если остался всего месяц, а у вас есть свободные даты, почему бы не заполнить их интересными проектами, которые принесут прибыль и увеличат ваше портфолио?
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<section id="hiw" class="hiw">
	<div class="container">
		<div class="row">
			<div class="col-xl-12">
				<div class="whats-it__title hiw__title">
					<span>
						Как работает Event Outlet?
					</span>
				</div>
				
			</div>
		</div>
		<div class="hiw-blocks">
			<div class="row">
				<div class="process-punkts__card">
					<span>Создайте анкету</span>
					<div class="process-punkts__number">
						<span>01</span>
					</div>
				</div>
				<div class="process-punkts__card">
					<span>Выбираете день в ближайшем месяце, в который вы готовы выполнить заказ со скидкой</span>
					<div class="process-punkts__number">
						<span>02</span>
					</div>
				</div>
				<div class="process-punkts__card">
					<span>Можете добавить одну дату, несколько дат или даже диапазон. Вы ничем не ограничены</span>
					<div class="process-punkts__number">
						<span>03</span>
					</div>
				</div>
				<div class="process-punkts__card">
					<span>Даете на каждое предложение специальную цену, скидку от 10% до 50%, на ваших условиях</span>
					<div class="process-punkts__number">
						<span>04</span>
					</div>
				</div>
				<div class="process-punkts__success">
					<span>Ура, ваше предложение на сайте! Клиент уже ищет вас</span>
				</div>
			</div>			
		</div>
		@guest
		<div class="hiw__button">
			<button class="thin-rectangle-btn rectangle-btn-border rectangle-btn-border-green open-register-modal">
				<span>Стать исполнителем</span>
			</button>
		</div>
		@endguest
	</div>
</section>

@endsection
@push('scripts')
<script src="{{ asset('js/pages/home.js') }}?global={{ env('JS_VERSION') }}&local=1"></script>
@endpush