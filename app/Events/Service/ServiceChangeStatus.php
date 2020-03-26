<?php

namespace App\Events\Service;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ServiceChangeStatus
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;

    public $status;

    public $message;

    /**
     * ServiceChangeStatus constructor.
     * @param $user
     * @param $message
     */
    public function __construct($user, $status, $message)
    {
        $this->user = $user;
        $this->status = $status;
        $this->message = $message;
    }
}
