<?php

namespace App\Events\User;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserChangeStatus
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var
     */
    public $status;

    /**
     * @var
     */
    public $user;

    /**
     * UserChangeStatus constructor.
     * @param $status
     * @param $user
     */
    public function __construct($status, $user)
    {
        $this->status = $status;
        $this->user = $user;
    }
}
