<?php

namespace App\Mail\Service;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StatusChange extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var
     */
    protected $services;

    /**
     * @var
     */
    protected $comments;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($services, $comments)
    {
        $this->services = $services;
        $this->comments = $comments;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Мы обновили статусы ваших услуг')
                    ->from(env('MAIL_SENDER'), env('APP_NAME'))
                    ->view('mails.service.status-change')
                    ->with(['services' => $this->services, 'comments' => $this->comments]);
    }
}
