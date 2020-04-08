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
        $subject = null;
        switch ($event->status) {
            case (User::ACTIVE_STATUS):
                $template .= 'active';
                $subject = 'Добро пожаловать на EventOutlet';
                break;
            // case (User::WAITING_STATUS):
            //     $template .= 'wait';
            //     break;
            case (User::REJECTED_STATUS):
                $template .= 'reject';
                $subject = 'Ошибка при регистрации на EventOutlet';
                break;
            // case (User::BANED_STATUS):
            //     $template .= 'baned';
            //     break;
        }
        if ($subject) {
            Mail::send($template, ['user' => $event->user], function ($message) use ($event, $subject) {
                $message->from('admin@eventoutlet.ru');
                $message->subject($subject);
                $message->to($event->user->email);
            });
        }   
        
    }
}
