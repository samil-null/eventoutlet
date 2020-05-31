<?php

namespace App\Mail\User;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ForgotPassword extends Mailable
{
    use Queueable, SerializesModels;

    protected $token;

    /**
     * ForgotPassword constructor.
     * @param string $rememberToken
     */
    public function __construct(string $token)
    {
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Восстановление пароля')
                ->from(env('MAIL_SENDER'), env('APP_NAME'))
                ->view('mails.user.forgot-password')
                ->with(['token' => $this->token]);
    }
}
