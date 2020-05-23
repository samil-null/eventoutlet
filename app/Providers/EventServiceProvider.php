<?php

namespace App\Providers;

use App\Listeners\User\SendForgotPasswordEmail;
use App\Events\User\Registration as UserRegistration;
use App\Events\User\ChangeStatus as UserChangeStatus;
use App\Events\User\ForgotPassword as UserForgotPassword;;
use App\Listeners\User\SendVerificationEmail;
use App\Listeners\User\SendEmailChangeUserStatus;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        UserRegistration::class => [
            SendVerificationEmail::class
        ],
        UserChangeStatus::class => [
            SendEmailChangeUserStatus::class
        ],
        UserForgotPassword::class => [
            SendForgotPasswordEmail::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
