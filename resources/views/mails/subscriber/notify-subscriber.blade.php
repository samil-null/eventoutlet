@extends('mails.layouts.index')

@section('content')
    @component('mails.templates.tags.p')
        Ура! На вашу дату появилось спецпредложение. Самое время познакомиться и забронировать <br>
    @endcomponent
    <div style="text-align: center; padding: 20px 0 40px;">
        @component('mails.templates.buttons.orange', ['url' => route('site.lk.offers.create')])
            Посмотреть предложения
        @endcomponent
    </div>
    @component('mails.templates.tags.p')
        Если вы уже нашли специалиста на вашу, вы можете просто <a href="#">отменить подписку</a>.<br>
        Бали рады вам помочь и до новых встреч!
    @endcomponent
@endsection
