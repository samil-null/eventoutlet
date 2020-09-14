<?php

namespace App\Mail\Subscribe;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewSubscriber extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var
     */
    protected $date;

    /**
     * NewSubscriber constructor.
     * @param string $date
     */
    public function __construct(string $date)
    {
        $this->date = $date;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Подписка на дату ' . $this->date)
            ->from(env('MAIL_SENDER'), env('APP_NAME'))
            ->view('mails.subscriber.subscribe');
    }
}
