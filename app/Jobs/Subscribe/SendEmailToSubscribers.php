<?php

namespace App\Jobs\Subscribe;

use App\Models\User;
use Carbon\Carbon;
use DB;
use App\Models\Offer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailToSubscribers implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $offer;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Offer $offer)
    {
        $this->offer = $offer;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $offer = $this->offer;
        $user = $this->offer->user;

        if ($user->status == User::ACTIVE_STATUS) {

            $subscribers = \DB::table('subscribers as s')
                ->leftJoin('subscribers_specialties as ss', 's.id', '=', 'ss.subscriber_id')
                ->join('subscribers_dates as sd', 's.id', '=', 'sd.subscriber_id')
                ->where('ss.specialty_id', $user->info->speciality_id)
                ->where('s.is_active', 1)
                ->where('s.city_id', $user->info->city_id)
                ->whereIn('sd.date', $this->offer->dates->pluck('date')->toArray())

                ->groupBy(['email', 'token'])
                ->get(['email', 'date', 'token'])
                ->toArray();

            if (!empty($subscribers)) {

                foreach ($subscribers as $subscriber) {

                    \Mail::send('mails.subscriber.notify-subscriber', ['slug' => $user->slug, 'offer' => $offer, 'token' => $subscriber->token], function ($message) use ($subscriber) {
                        $message->from(env('MAIL_SENDER'), env('APP_NAME'));
                        $message->subject('Спецпредложение на вашу дату ' . Carbon::create($subscriber->date)->format('d.m.Y'));
                        $message->to($subscriber->email);
                    });
                }

                


            }

        }

    }
}
