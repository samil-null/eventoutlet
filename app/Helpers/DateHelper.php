<?php


namespace App\Helpers;


use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Collection;

class DateHelper
{
    public static $ruMonth = [
        1 => 'января',
        2 => 'февраля',
        3 => 'марта',
        4 => 'апреля',
        5 => 'мая',
        6 => 'июня',
        7 => 'июля',
        8 => 'августа',
        9 => 'сентября',
        10 => 'октября',
        11 => 'ноября',
        12 => 'декабря'
    ];

    protected static $ruMonthTranslate = [
        'january'   => 'Январь',
        'february'  => 'Февраль',
        'april'     => 'Апрель',
        'march'     => 'Март',
        'may'       => 'Май',
        'june'      => 'Июнь',
        'july'      => 'Июль',
        'august'    => 'Август',
        'september' => 'Сентябрь',
        'october' => 'Октябрь',
        'november'  => 'Ноябрь',
        'december'  => 'Декабрь'
    ];

    const FULL_DATE_FORMAT = 'd.m.y';

    const FILTER_DATE_FORMAT = 'Y-m-d';

    /**
     * @param Collection $dates
     * @return string
     */
    public static function displayRangeDates(Collection $dates)
    {
        $startDate = $dates->min('date');
        $endDate = $dates->max('date');

        if ($dates->count() == 1) {
            return Carbon::parse($dates->first()->date)->format('d.m.y');
        }

        $parseStartDate = Carbon::parse($startDate);
        $parseEndDate = Carbon::parse($endDate);

        if ($parseStartDate->year == $parseEndDate->year) {

            if ($parseStartDate->month == $parseEndDate->month) {
                return self::concatDate($startDate, $endDate, 'd', 'd.m.y');
            }

            return self::concatDate($startDate, $endDate, 'd.m', 'd.m.y');
        }

        return self::concatDate($startDate, $endDate);

    }

    /**
     * @param $start
     * @param $end
     * @param null $startPattern
     * @param null $endPattern
     * @return string
     */
    private static function concatDate($start, $end, $startPattern = null, $endPattern = null)
    {
        return Carbon::parse($start)->format($startPattern?? self::FULL_DATE_FORMAT) . ' - ' .
            Carbon::parse($end)->format($endPattern?? self::FULL_DATE_FORMAT);
    }

    /**
     * @param $value
     * @param $side
     * @return mixed
     */
    public static function filterPrepare($value, $side)
    {
        $now = Carbon::now();

        try {
            $date = Carbon::parse($value);
        } catch (\Exception $e) {
            if ($side == 'from') return Carbon::now()->format(self::FILTER_DATE_FORMAT);
            if ($side == 'to') return Carbon::now()->addDays(31)->format(self::FILTER_DATE_FORMAT);
        }

        if ($date->diffInDays($now, false) > 0 || $date->diffInDays($now, false) < -31) {
            if ($side == 'from') return Carbon::now()->format(self::FILTER_DATE_FORMAT);
            if ($side == 'to') return Carbon::now()->addDays(31)->format(self::FILTER_DATE_FORMAT);
        }

        return $date->format(self::FILTER_DATE_FORMAT);
    }

    /**
     * @param $date
     * @return string
     */
    public static function toDateFilter($date)
    {
        $date = Carbon::parse($date);

        return 'До ' . $date->day . ' ' . self::$ruMonth[$date->month];
    }

    /**
     * @return mixed
     */
    public static function minFilterDate()
    {
        return Carbon::now()->format('d-m-Y');
    }

    /**
     * @return mixed
     */
    public static function maxFilterDate()
    {
        return Carbon::now()->addDays(31)->format('d-m-Y');
    }

    /**
     * @param $dates
     * @return mixed
     */
    public static function flatDate($dates)
    {
        return $dates->map(function($date) {
            return $date->date;
        });
    }

    public static function createCalendarDateRange()
    {
        $period = CarbonPeriod::create(Carbon::now()->format('j-m-Y'), Carbon::now()->addDays(31)->format('j-m-Y'));

        $calendar = [];

        foreach ($period as $item) {
            $dayOfWeek = ($item->dayOfWeek == 0)? 7: $item->dayOfWeek;
            $month = $item->month < 10 ? '0' . $item->month : $item->month;
            $calendar[$item->year][$month][$item->week][$dayOfWeek] = $item->day;
        }

        // foreach ($calendar as $year => $months) {
        //     //echo "year: $year<br>";
        //     foreach ($months as $month => $weeks) {
        //         //echo DateHelper::$ruMonth[$month] . "<br>";
        //         foreach ($weeks as $week => $days) {
        //             //  echo $week . "<br>";
        //             echo "<tr>";
        //             foreach ([1,2,3,4,5,6,7] as $index) {
        //                 //dd($days);
        //                 $val = $days[$index]?? ' ';
        //                 echo "<td>" . $val ."<td>";
        //             }
        //             echo "</tr>";
        //         }
        //     }
        // }

        return $calendar;
    }

    /**
     * @param int $value
     * @return int|string\
     */
    public static function zero(int $value)
    {
        if ($value < 10) return '0' . $value;

        return $value;
    }

    /**
     * @param string $name
     * @return string
     */
    public static function monthTranslate(string $name)
    {
        return self::$ruMonthTranslate[strtolower($name)];
    }
}
