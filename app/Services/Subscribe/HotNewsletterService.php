<?php

namespace App\Services\Subscribe;


use App\Models\User;
use Carbon\Carbon;

class HotNewsletterService
{
    public function execute(array $dates, int $cityId, array $specialty)
    {
        //$datesCollection = collect($dates);
        //dd($dates);

        $maxDate = Carbon::now();



        foreach ($dates as $date) {
            if ($maxDate->diffInDays($date) <= 7) {
            	$emails = User::where('status', User::ACTIVE_STATUS)
            			->where('subscription_status', 1)
            			->whereHas('info', function ($query) use ($cityId, $specialty) {
            				$query->where('city_id', $cityId)
            						->whereIn('speciality_id', $specialty);
            			})
                        ->groupBy('email')
            			->get();
            				

            	//planner.done@yandex.ru lobanovaspb@ya.ru
            	foreach ($emails as $email) {

       
            		\Mail::send('mails.subscriber.notify-executors-hote', [
            			'date' => Carbon::parse($date)->format('d.m.Y'),
            			'token'	=> $email->email_verified_token
            		], function ($message) use ($email) {
                            $message->from(env('MAIL_SENDER'), env('APP_NAME'));
                            $message->subject('🔥HOT! Запрос на эту неделю');
                            $message->to($email->email);
                    });

            	}
            
            }
        }
    }
}
