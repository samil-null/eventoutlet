@extends('mails.layouts.index')

@section('content')
    @component('mails.templates.tags.h1')
        Ура! На вашу дату появилось спецпредложение. Самое время познакомиться и забронировать <br>
    @endcomponent
    <table width="100%" style="margin-bottom: 10px; padding: 10px 20px 30px; border-spacing: 0;background-color: #f3f3f3; border-radius: 5px;">
    <tbody>

            <tr>
                <td style="padding:13px 0px; border-bottom:1px solid #c2c2c2; color: #333;font-size: 16px;">
                    {{ $offer->user->speciality->name }}
                </td>
                <td style="padding:13px 0px; border-bottom:1px solid  #c2c2c2; color: #333;font-size: 16px;">
                    {{ $offer->user->name }}
                </td>
                <td style="padding:13px 0px; border-bottom:1px solid #c2c2c2;color: #333;font-size: 16px;">
                    {{ $offer->discount_price }}

                    {{ $offer->service->priceOption->name }}
                </td>
            </tr>
            <tr>
                <td colspan="3" style="padding: 4px 0px 14px;">
                    <span style="color:#333; font-size: 14px;">Условия:</span>
                    <div>
                        <p style="font-size: 15px;color:#000;margin: 0;">
                            {{ $offer->description }}
                        </p>
                    </div>

                </td>
            </tr>
    </tbody>
</table>
    <div style="text-align: center; padding: 20px 0 40px;">
        @component('mails.templates.buttons.orange', ['url' => route('site.users.show', $slug)])
            Посмотреть предложения
        @endcomponent
    </div>
    @component('mails.templates.tags.p')
        Если вы уже нашли специалиста на вашу, вы можете просто <a href="{{ route('site.subscribe-disable', $token) }}">отменить подписку</a>.<br>
        Бали рады вам помочь и до новых встреч!
    @endcomponent
@endsection
