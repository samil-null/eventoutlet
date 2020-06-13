<?php

namespace App\Listeners\System;

use Mail;
use App\Mail\System\RegisterNewUser;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendEmailRegisterNewUser
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
        Mail::to(env('MAIL_SENDER'))->send(new RegisterNewUser());
    }
}
