<?php

namespace App\Events\Offer;

use App\Models\Offer;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OfferChangeStatus
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var int
     */
    public $status;

    /**
     * @var null|string
     */
    public $message;

    /**
     * @var User
     */
    public $user;

    /**
     * OfferChangeStatus constructor.
     * @param int $status
     * @param User $user
     * @param null $message
     */
    public function __construct(int $status, User $user, $message = null)
    {
        $this->status = $status;
        $this->user = $user;
        $this->message = $message;
    }
}
