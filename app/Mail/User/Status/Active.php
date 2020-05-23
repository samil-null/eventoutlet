<?php

namespace App\Mail\User\Status;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Active extends Mailable
{
    use Queueable, SerializesModels;

    protected $services;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($services)
    {
        $this->services = $services;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('😃 Добро пожаловать на EventOutlet')
                    ->view('mails.user.status.active')
                    ->with(['services' => $this->services]);
    }
}
