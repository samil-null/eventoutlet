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
     * @var string
     */
    protected $date;

    /**
     * @var string
     */
    protected $token;

    /**
     * NewSubscriber constructor.
     * @param string $dates
     * @param string $token
     */
    public function __construct(array $dates, string $token)
    {
        $this->date = $dates;
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        dd($this->dates);
        return $this->subject('Подписка на дату ' . $this->date)
            ->from(env('MAIL_SENDER'), env('APP_NAME'))
            ->view('mails.subscriber.subscribe')
            ->with(['token' => $this->token]);
    }
}
