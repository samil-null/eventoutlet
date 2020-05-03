<?php

namespace App\Listeners\User;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendForgotEmailUser
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
        Mail::send('mails.user.forgot', ['user' => $event->user, 'token' => $event->token], function ($message) use ($event) {
            $message->from('admin@eventoutlet.ru');
            $message->subject('Восстановление пароля на Eventoutlet');
            $message->to($event->user->email);
        });
    }
}
