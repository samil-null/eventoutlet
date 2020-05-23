@extends('mails.layouts.index')

@section('content')
   @component('mails.templates.tags.h1')
      Ваш аккаунт успешно прошел модерацию! 
   @endcomponent

   @component('mails.templates.tags.p')
      Статус ваших услуг, прошедших модерацию: 
   @endcomponent

   @component('mails.templates.tables.services', ['services' => $services])
   @endcomponent

   @component('mails.templates.tags.p')
      Информация о вас и ваших услугах уже появилась на портале Event Outlet. <br>
      Но вы можете еще добавить спецпредложения на те даты, которые остались свободными. Сделайте свою работу более продуктивной!
   @endcomponent

   <div style="text-align: center; padding: 20px 0 40px;">
		@component('mails.templates.buttons.orange', ['url' => route('site.lk.offers.create')])
			Добавить спецпредложение
		@endcomponent
	</div>

   @component('mails.templates.tags.p')
      А как это работает? <br>
      - выбираете ранее указанные вами услуги и день в ближайшем месяце, в который вы готовы выполнить их со скидкой <br>
      - можете добавить одну дату, несколько дат или даже диапазон. Вы ничем не ограничены <br>
      - даете на каждое предложение специальную цену, скидку от 10% до 50% <br>
      - обязательно пропишите те условия, на которых вы готовы работать (минимальный заказ, удаленность и пр) <br>
      Done!
   @endcomponent

   @component('mails.templates.tags.p')
      Клиент находит вас и сам пишет или звонит! Пустых дней в этом месяце все меньше, работы все больше!
   @endcomponent

   @component('mails.templates.tags.p')
      EventOutlet это портал, который помогает сделать работу еще более продуктивной, увеличить запись на месяц вперед и не простаивать. 
   @endcomponent

   @component('mails.templates.tags.p')
      Желаем тебе много интересной работы! <br>
      Если что-то не получилось или остались вопросы, пиши.
   @endcomponent
@endsection











