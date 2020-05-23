<?php

namespace App\Listeners\User;

use App\Events\User\Registration;

class SendVerificationEmail
{

    /**
     * Handle the event.
     *
     * @param  RegisterNewUser  $event
     * @return void
     */
    public function handle(Registration $event)
    {
        $event->user->notify(new \App\Notifications\User\Verification());
    }
}
