<?php

namespace App\Listeners\Service;

use App\Models\Offer;
use App\Models\Service;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendEmailChangeServiceStatus
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $template = 'mails.service.status.';

        switch ($event->status) {
            case(Service::ACTIVE_STATUS):
                $template .= 'active';
                break;
            case (Offer::REJECTED_STATUS):
                $template .= 'reject';
                break;
            default:
                throw new \Exception('Неизвестный статус');
        }

        Mail::send($template, ['user' => $event->user, '_message' => $event->message], function ($message) use ($event) {
            $message->from('info@eventoutlet.ru');
            $message->to($event->user->email);
        });

    }
}
