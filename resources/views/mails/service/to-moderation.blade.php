@extends('mails.layouts.index')

@section('content')
    @component('mails.templates.tags.h1')
        Добрый день!
    @endcomponent
    @component('mails.templates.tags.p')
        Вы обновили информацию об услугах на сайте, и они вновь проходят проверку. Мы ценим достоверность указанной информации на портале Event Outlet.
    @endcomponent

    @component('mails.templates.tags.p')
        Модерация может занять до 48 часов.
    @endcomponent

    @component('mails.templates.tags.p')
        EventOutlet это портал, который помогает сделать работу еще более продуктивной, увеличить запись на месяц вперед и не простаивать.
    @endcomponent

    @component('mails.templates.tags.p')
        Желаем тебе много интересной работы!<br>
        Если что-то не получилось или остались вопросы, пиши.
    @endcomponent
@endsection
