@extends('mails.layouts.index')

@section('content')
    @component('mails.templates.tags.p')
        На Event Outlet появились новые запросы на твою услугу. Самое время разместить спецпредложения на эти даты. Как только вы разместите предложение, клиент получит уведомление на почту и сможет с вами связаться. Медлить не стоит!
    @endcomponent

    @foreach($calendar as $year => $months)

        @foreach($months as $month => $weeks)
           {{--  <p>{{ \App\Helpers\DateHelper::$ruMonth[$month] }}</p> --}}
           <p style="text-align: center; font-size: 18px; font-weight: bold; color: #333;">{{ \App\Helpers\DateHelper::monthTranslate(Carbon\Carbon::parse($year. '-' . $month . '-1')->format('F')) }}</p>
            <table width="350px" style="margin: 0 auto; padding: 30px 0;border: 1px solid #ccc; border-radius: 10px;">
                @foreach($weeks as $week => $days)                

                    <tr>
                        @foreach([1,2,3,4,5,6,7] as $index)
                            <td  style="width: 30px;height: 30px; vertical-align: middle; text-align: center;font-size:18px;" >
                                @if (in_array($year . "-" . $month . "-" . \App\Helpers\DateHelper::zero($days[$index]??0),  $dates->pluck('date')->toArray()))
                                    <span style="color: #fff;background: #ff7061;border-radius: 50%;padding: 4px;display: block;width: 30px;height: 30px;margin: 0 auto;box-sizing: border-box;line-height: 22px;">
                                    {{ $days[$index]?? ' ' }}
                                </span>
                                
                                @else
                                   <span style="color: #333">{{ $days[$index]?? ' ' }}</span>                            
                                @endif
                            </td>
                        @endforeach                        
                    </tr>
                @endforeach 
            </table>

        @endforeach 


    @endforeach

    @component('mails.templates.tags.p')
        Если вы не хотите получать рассылку актуальных запросов, вы можете просто <a href="#">отменить подписку</a>.
        Бали рады вам помочь и до новых встреч!
    @endcomponent
@endsection
