@extends('mails.layouts.index')

@section('content')
    @component('mails.templates.tags.h1')
        Мы рады видеть тебя на портале EventOutlet.
    @endcomponent

    <div style="text-align: center; padding: 20px 0 40px;">
        @component('mails.templates.buttons.orange', ['url' => route('remember', $token)])
            Восстановить пароль
        @endcomponent
    </div>

@endsection
