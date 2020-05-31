@extends('mails.layouts.index')

@section('content')

    @component('mails.templates.tags.h1')
        Восстановление пароля
    @endcomponent

    @component('mails.templates.tags.p')
        Вы запросили восстановление пароля от аккаунта Event Outlet.
    @endcomponent



    <div style="text-align: center; padding: 20px 0 40px;">
        @component('mails.templates.buttons.orange', ['url' => route('remember', $token)])
            Восстановить пароль
        @endcomponent
    </div>

    @component('mails.templates.tags.p')
        Желаем тебе много интересной работы! <br>
        Если что-то не получилось или остались вопросы, пиши.
    @endcomponent

@endsection
