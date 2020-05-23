@extends('mails.layouts.index')

@section('content')
    @component('mails.templates.tags.h1')
        Аккаунт на модерации
    @endcomponent
   @component('mails.templates.tags.p')
      Ваш аккаунт на модерации! Как только мы проверим достоверность указанной информации вам придет письмо, и аккаунт появится на сайте.
      Модерация может занять до 48 часов.
   @endcomponent
   @component('mails.templates.tags.p')
      Желаем много интересной работы!<br>
      Если что-то не получилось или остались вопросы, пиши.
   @endcomponent
@endsection
