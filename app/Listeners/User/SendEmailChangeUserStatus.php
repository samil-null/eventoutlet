<?php

namespace App\Listeners\User;

use Illuminate\Mail\Mailable;
use \App\Events\User\ChangeStatus as UserChangeStatusEvent;
use App\Notifications\User\ChangeStatus;
use App\Mail\User\Status\{Active, Wait, Reject};
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendEmailChangeUserStatus
{

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(UserChangeStatusEvent $event)
    {
        $instance = null;

        switch ($event->status) {
            case (User::ACTIVE_STATUS):
                $instance = new Active($event->user->services);
                break;
            case (User::WAITING_STATUS):
                $instance = new Wait();
                break;
            case (User::REJECTED_STATUS):
                $instance = new Reject();
                break;
        }

        if ($instance instanceof Mailable) {
            $event->user->notify(new ChangeStatus($instance));
        }

    }
}
