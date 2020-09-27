<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Specialty;
use App\Models\City;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class WeeklySendEmailToExecutors extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'executors:weekly-send-email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {


        foreach (Specialty::all() as $specialty) {

            foreach (City::all() as $city) {
                $dates = \DB::table('subscribers as s')
                        ->leftJoin('subscribers_specialties as ss', 'ss.subscriber_id', '=', 's.id')
                        ->where('ss.speciality_id', $specialty->id)
                        ->where('s.city_id', $city->id)
                        ->whereBetween('s.date', [Carbon::now()->format('Y-m-d'), Carbon::now()->addMonths(1)->format('Y-m-d')])
                        ->where('s.is_active', 1)
                        ->groupBy('s.date')
                        ->get(['s.date', \DB::raw('count(s.date) as count')]);

                if ($dates->count()) {

                    $emails = User::where('status', User::ACTIVE_STATUS)->whereHas('info', function ($query) use ($city, $specialty) {
                        $query->where('city_id', '=', $city->id)
                              ->where('speciality_id', '=', $specialty->id);
                    })
                    ->get(['email'])
                    ->pluck('email')
                    ->toArray();

                    //dump($emails);

//                    $_emails = [
//                        'denis.budancev@gmail.com',
//                        'planner.done@yandex.ru',
//                        'lobanovaspb@ya.ru'
//                    ];

                    dump($emails);

                    if (in_array('denis.budancev@gmail.com', $emails) ) {
                        \Mail::send('mails.subscriber.notify-executors', ['dates' => $dates], function ($message) use ($emails, $city, $specialty) {
                            $message->from(env('MAIL_SENDER'), env('APP_NAME'));
                            $message->subject('Запрос на услугу ' . $city->name . ' ' . $specialty->name);
                            $message->to('denis.budancev@gmail.com');
                        });
                    }

                    if (in_array('planner.done@yandex.ru', $emails) ) {
                        \Mail::send('mails.subscriber.notify-executors', ['dates' => $dates], function ($message) use ($emails, $city, $specialty) {
                            $message->from(env('MAIL_SENDER'), env('APP_NAME'));
                            $message->subject('Запрос на услугу ' . $city->name . ' ' . $specialty->name);
                            $message->to('planner.done@yandex.ru');
                        });
                    }

                    if (in_array('lobanovaspb@ya.ru', $emails) ) {
                        \Mail::send('mails.subscriber.notify-executors', ['dates' => $dates], function ($message) use ($emails, $city, $specialty) {
                            $message->from(env('MAIL_SENDER'), env('APP_NAME'));
                            $message->subject('Запрос на услугу ' . $city->name . ' ' . $specialty->name);
                            $message->to('lobanovaspb@ya.ru');
                        });
                    }
                    //$emails = array_diff($_emails, );


//                    \Mail::send('mails.subscriber.notify-executors', ['dates' => $dates], function ($message) use ($emails, $city, $specialty) {
//                        $message->from(env('MAIL_SENDER'), env('APP_NAME'));
//                        $message->subject('Запрос на услугу ' . $city->name . ' ' . $specialty->name);
//                        $message->to($emails);
//                    });

                }
            }

        }
    }
}
