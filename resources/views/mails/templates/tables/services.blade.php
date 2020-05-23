<table width="100%" style="margin-bottom: 10px; padding: 10px 20px 30px; border-spacing: 0;background-color: #f3f3f3; border-radius: 5px;">
    <thead>
        <tr>
            <td style="padding: 10px; border-bottom:1px solid #c2c2c2;font-size: 16px;">
                Название
            </td>
            <td style="padding: 10px;border-bottom:1px solid #c2c2c2;font-size: 16px;">
                Цена
            </td>
            <td style="padding: 10px;border-bottom:1px solid #c2c2c2;font-size: 16px;">
                Статус
            </td>
        </tr>
    </thead>
    <tbody>
        @foreach($services as $service)
            <tr>
                <td style="padding:13px 0px; border-bottom:1px solid @if (empty($comments[$service->id]))#c2c2c2 @else #efefef @endif; color: #333;font-size: 16px;">
                    {{ $service->name }}
                </td>
                <td style="padding:13px 0px; border-bottom:1px solid @if (empty($comments[$service->id]))#c2c2c2 @else #efefef @endif;color: #333;font-size: 16px;">
                    {{ $service->price }}

                    {{ $service->priceOption->name }}
                </td>
                <td style="padding:13px 0px; border-bottom:1px solid @if (empty($comments[$service->id]))#c2c2c2 @else #efefef @endif; color: #333; font-size: 16px;">
                    {{ $service->getStatus('name') }}
                </td>
            </tr>

            @if (!empty($comments[$service->id]))
                <tr>
                    <td colspan="3" style="border-bottom:1px solid #c2c2c2;padding: 4px 0px 14px;">
                        <span style="color:#333; font-size: 14px;">Комментарий:</span>
                        <div>
                            <p style="font-size: 15px;color:#000;margin: 0;">
                                {{ $comments[$service->id] }}
                            </p>
                        </div>

                    </td>
                </tr>
            @endif

        @endforeach
    </tbody>
</table>
