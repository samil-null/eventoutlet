<h1>Уважаемый {{ $user->name }}</h1>
<p>ваше спецпредложение ожидает модерации</p>

@if ($_message)
    <p style="color: red;">{!! $_message !!}</p>
@endif
