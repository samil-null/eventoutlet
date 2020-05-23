@extends('mails.layouts.index')

@section('content')
    @component('mails.templates.tags.h1')
        Мы рады видеть тебя на портале EventOutlet.
	@endcomponent

	@component('mails.templates.tags.p')
        Для продолжения работы необходимо верифицировать аккаунт.
	@endcomponent

	@component('mails.templates.tags.p')
		Информация о вас и ваших услугах обновилась на портале Event Outlet. <br>
		Теперь вы можете добавить спецпредложения на те даты, которые остались свободными. Сделайте свою работу более продуктивной! <br>
	@endcomponent

	<div style="text-align: center; padding: 20px 0 40px;">
		@component('mails.templates.buttons.dark', ['url' => route('verification', $user->email_verified_token)])
            Верифицировать аккаунт
		@endcomponent
	</div>

	@component('mails.templates.tags.p')
        Как заполнить анкету? <br>
        - перейдите на сайт <br>
        - введите свой логин и пароль <br>
        - заполните анкету <br>
        - заполните данные с вашими услугами (от 1 до 6 вариантов ваших услуг) <br>
        - далее ваш акканут уйдет на модерацию, так как мы проверяем всю указанную информацию на достоверность. <br> 
	@endcomponent
	
	@component('mails.templates.tags.p')
        EventOutlet это портал, который помогает сделать работу еще более продуктивной, увеличить запись на месяц вперед и не простаивать. 
	@endcomponent

	@component('mails.templates.tags.p')
        Почему только ближайший месяц? Мы не видим смысла всегда работать со скидкой, тем самым обесценивая свой труд. Но если остался всего месяц, а у вас есть свободные даты, почему бы не заполнить их интересными проектами, которые принесут прибыль и увеличат ваше портфолио?
	@endcomponent

	@component('mails.templates.tags.p')
        Желаем много интересной работы!
        Если что-то не получилось или остались вопросы, пиши.
	@endcomponent

@endsection