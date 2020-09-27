@extends('mails.layouts.index')

@section('content')
    @component('mails.templates.tags.h1')
        Решили дождаться самого выгодного предложения? И правильно сделали!
    @endcomponent

    @component('mails.templates.tags.p')
        @if(!$minMonth)
            Спецпредложения начнут появляться за 31 день до вашей даты.<br>
        @endif
        Вся актуальная информацию придет вам на почту. <br>
    @endcomponent
    <div style="text-align: center; padding: 20px 0 40px;">
        @component('mails.templates.buttons.orange', ['url' => route('site.subscribe-enable', $token)])
            Подтвердить подписку
        @endcomponent
    </div>

@endsection
