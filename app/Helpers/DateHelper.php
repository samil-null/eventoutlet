<?php


namespace App\Helpers;


use Carbon\Carbon;
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

    private const FULL_DATE_FORMAT = 'd.m.y';

    private const FILTER_DATE_FORMAT = 'Y-m-d';

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

    private static function concatDate($start, $end, $startPattern = null, $endPattern = null)
    {
        return Carbon::parse($start)->format($startPattern?? self::FULL_DATE_FORMAT) . ' - ' .
            Carbon::parse($end)->format($endPattern?? self::FULL_DATE_FORMAT);
    }

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

    public static function toDateFilter($date)
    {
        $date = Carbon::parse($date);

        return 'До ' . $date->day . ' ' . self::$ruMonth[$date->month];
    }

    public static function minFilterDate()
    {
        return Carbon::now()->format('d-m-Y');
    }

    public static function maxFilterDate()
    {
        return Carbon::now()->addDays(31)->format('d-m-Y');
    }

    public static function flatDate($dates)
    {
        return $dates->map(function($date) {
            return $date->date;
        });
    }
}
