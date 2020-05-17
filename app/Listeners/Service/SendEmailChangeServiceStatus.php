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
        $subject = '';

        switch ($event->status) {
            case(Service::ACTIVE_STATUS):
                $template .= 'active';
                $subject = 'Ваша услуга принята';
                break;
            case (Offer::REJECTED_STATUS):
                $template .= 'reject';
                $subject = 'Ваша услуга отклонена';
                break;
            default:
                throw new \Exception('Неизвестный статус');
        }

        Mail::send($template, ['user' => $event->user, '_message' => $event->message], function ($message) use ($event, $subject) {
            $message->from('admin@eventoutlet.ru');
            $message->subject($subject);
            $message->to($event->user->email);
        });

    }
}
