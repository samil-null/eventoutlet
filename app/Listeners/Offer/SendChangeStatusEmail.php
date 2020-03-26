<?php

namespace App\Listeners\Offer;

use App\Models\Offer;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendChangeStatusEmail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $template = 'mails.offer.status.';

        switch ($event->status) {
            case(Offer::ACTIVE_STATUS):
                $template .= 'active';
                break;
            case (Offer::WAITING_STATUS):
                $template .= 'wait';
                break;
            case(Offer::REJECTED_STATUS):
                $template .= 'reject';
                break;
        }

        Mail::send($template, ['user' => $event->user, '_message' => $event->message], function ($message) use ($event) {
            $message->from('info@eventoutlet.ru');
            $message->to($event->user->email);
        });
    }
}
