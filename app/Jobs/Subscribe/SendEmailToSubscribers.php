<?php

namespace App\Jobs\Subscribe;

use App\Models\User;
use DB;
use App\Models\Offer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

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

        $user = $this->offer->user;

        if ($user->status == User::ACTIVE_STATUS) {

            $emails = \DB::table('subscribers as s')
                ->leftJoin('subscribers_specialties as ss', 's.id', '=', 'ss.subscriber_id')
                ->where('ss.speciality_id', $user->info->speciality_id)
                ->where('s.city_id', $user->info->city_id)
                ->whereIn('s.date', $this->offer->dates->pluck('date')->toArray())
                ->get(['email']);
        }

    }
}
