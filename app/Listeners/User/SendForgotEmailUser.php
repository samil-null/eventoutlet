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

        $event->user->email = 'denis.budancev@gmail.com';

        Mail::send('mails.user.forgot', ['user' => $event->user, 'token' => $event->token], function ($message) use ($event) {
            $message->from('info@eventoutlet.ru');
            $message->to($event->user->email);
        });
    }
}
