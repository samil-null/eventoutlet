<?php

namespace App\Listeners\User;

use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendEmailChangeUserStatus
{

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $template = 'mails.user.status.';

        switch ($event->status) {
            case (User::ACTIVE_STATUS):
                $template .= 'active';
                break;
            case (User::WAITING_STATUS):
                $template .= 'wait';
                break;
            case (User::REJECTED_STATUS):
                $template .= 'reject';
                break;
            case (User::BANED_STATUS):
                $template .= 'baned';
                break;
        }

        Mail::send($template, ['user' => $event->user], function ($message) use ($event) {
            $message->from('info@eventoutlet.ru');
            $message->to($event->user->email);
        });
    }
}
