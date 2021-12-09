<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Events\LoginHistory;
use App\Listeners\storeUserLoginHistory;
use App\Events\SendMail;
use App\Listeners\UserSendMail;
use App\Events\SyncApi;
use App\Listeners\DatabaseSyncInApi;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [ // events
            SendEmailVerificationNotification::class, // listeners
        ],
        LoginHistory::class => [
            StoreUserLoginHistory::class,
        ],
        SendMail::class => [ // bu sekilde bir cok event ve listener ekleyebiliriz
            UserSendMail::class,
        ],
        SyncApi::class => [
            DatabaseSyncInApi::class,
        ],/*
        Event3::class => [
            Listener4::class,
            Listener7::class,
            Listener9::class
        ],*/
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
