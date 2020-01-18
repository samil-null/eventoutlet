<?php

namespace App\Providers;

use App\Events\Offer\OfferChangeStatus;
use App\Events\RegisterNewUser;
use App\Events\User\UserChangeStatus;
use App\Events\User\UserForgotPassword;
use App\Listeners\Offer\SendChangeStatusEmail;
use App\Listeners\SendVerifecatedEmail;
use App\Listeners\SendVerificationEmail;
use App\Listeners\User\SendEmailChangeUserStatus;
use App\Listeners\User\SendForgotEmailUser;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        RegisterNewUser::class => [
            SendVerificationEmail::class
        ],
        OfferChangeStatus::class => [
            SendChangeStatusEmail::class
        ],
        UserChangeStatus::class => [
            SendEmailChangeUserStatus::class
        ],
        UserForgotPassword::class => [
            SendForgotEmailUser::class
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
