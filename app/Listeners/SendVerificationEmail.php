<?php

namespace App\Listeners;

use App\Events\RegisterNewUser;
use Illuminate\Support\Facades\Mail;

class SendVerificationEmail
{

    /**
     * Handle the event.
     *
     * @param  RegisterNewUser  $event
     * @return void
     */
    public function handle(RegisterNewUser $event)
    {
//        Mail::send('mails.verification', ['user' => $event->user], function ($message) use ($event) {
//            $message->from('admin@eventoutlet.ru');
//            $message->to($event->user->email);
//        });
//
//        Mail::send('mails.user.success-register', ['user' => $event->user], function ($message) use ($event) {
//            $message->subject('Регистрация на EventOutlet');
//            $message->from('admin@eventoutlet.ru');
//            $message->to($event->user->email);
//        });
    }
}
