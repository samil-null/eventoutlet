<h1>Уважаемый {{ $user->name }}</h1>
<p>ваша услуга отклонена</p>

@if ($_message)
    <p style="color: red;">{!! $_message !!}</p>
@endif


