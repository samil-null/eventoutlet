@extends('mails.layouts.index')

@section('content')
    @component('mails.templates.tags.p')
        Вы подписались  Как только на портале появятся актуальные предложения, вам тут же придет письмо. Стоит только совсем немного подождать.

        Вы подписались на @if($singleDate)дату:@else даты: @endif {{ $dates }}. 
        Как только на портале появятся актуальные предложения, вам тут же придет письмо. 
        Стоит только совсем немного подождать. 
    @endcomponent

    @component('mails.templates.tags.p')
       Если предложение все-таки не пришло вы всегда можете найти подходящего специалиста в <a href="{{ route('site.offers.index') }}">каталоге Event Outlet.</a>
    @endcomponent
@endsection
