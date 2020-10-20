<?php


namespace App\Services\Subscribe;


use App\Models\User;
use Carbon\Carbon;

class HotNewsletterService
{
    public function execute(array $dates, int $cityId, array $specialty)
    {
        //$datesCollection = collect($dates);

        $maxDate = Carbon::now();



        foreach ($dates as $date) {
            if ($maxDate->diff(Carbon::create($date)->format('d-m-Y')) <= 7) {

            }
        }
    }
}
