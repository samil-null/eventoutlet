@extends('mails.layouts.index')

@section('content')
    @component('mails.templates.tags.p')
       На Event Outlet появился запрос для вас, на {{ $date }}. Самое время разместить спецпредложение на эту даты. Как только вы разместите предложение, клиент получит уведомление на почту и сможет с вами связаться. Медлить не стоит! 
    @endcomponent

    <div style="text-align: center; padding: 20px 0 40px;">
        @component('mails.templates.buttons.orange', ['url' => route('site.lk.offers.create')])
            Добавить спецпредложение
        @endcomponent
    </div>

    @component('mails.templates.tags.p')
        Если вы не хотите получать рассылку актуальных запросов, вы можете просто отменить подписку. 
        Возобновить рассылку вы можете в личном кабинете.
        Бали рады вам помочь и до новых встреч!
    @endcomponent
@endsection
