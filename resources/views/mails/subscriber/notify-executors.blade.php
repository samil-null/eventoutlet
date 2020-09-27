@extends('mails.layouts.index')

@section('content')
    @component('mails.templates.tags.p')
        На Event Outlet появились новые запросы на твою услугу. Самое время разместить спецпредложения на эти даты. Как только вы разместите предложение, клиент получит уведомление на почту и сможет с вами связаться. Медлить не стоит!
    @endcomponent
    <table width="100%" style="margin-bottom: 10px; padding: 10px 20px 30px; border-spacing: 0;background-color: #f3f3f3; border-radius: 5px;">
        <thead>
            <tr>
                <td style="padding: 10px; border-bottom:1px solid #c2c2c2;font-size: 16px;">
                    Дата
                </td>
                <td style="padding: 10px;border-bottom:1px solid #c2c2c2;font-size: 16px;">
                    Кол-во
                </td>
            </tr>
        </thead>
    <tbody>
        @foreach($dates as $date)
            <tr>
                <td style="padding:13px 0px; border-bottom:1px solid #c2c2c2; color: #333;font-size: 16px;">
                    {{ \Carbon\Carbon::create($date->date)->format('d.m.Y') }}
                </td>
                <td style="padding:13px 0px; border-bottom:1px solid  #c2c2c2; color: #333;font-size: 16px;">
                    {{ $date->count }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
    @component('mails.templates.tags.p')
        Если вы не хотите получать рассылку актуальных запросов, вы можете просто <a href="#">отменить подписку</a>.
        Бали рады вам помочь и до новых встреч!
    @endcomponent
@endsection
