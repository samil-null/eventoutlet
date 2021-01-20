<?php

namespace App\Mail\Subscribe;

use Carbon\Carbon;
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
        $this->dates = $dates;
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Подписка на дату')
            ->from(env('MAIL_SENDER'), env('APP_NAME'))
            ->view('mails.subscriber.subscribe')
            ->with([
                'token' => $this->token, 
                'dates' => implode(', ', $this->dates), 
                'singleDate' => (count($this->dates) == 1)
            ]);
    }
}
