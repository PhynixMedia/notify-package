<?php

namespace Notify\App;

use App\Providers\EventServiceProvider;
use Notify\App\EventListeners\EmailEventListener;
use Notify\App\EventListeners\FcmEventListener;
use Notify\App\EventListeners\SmsEventListener;
use Notify\App\Events\EmailEvent;
use Notify\App\Events\FcmEvent;
use Notify\App\Events\SmsEvent;

class NotifyEventServiceProvider extends EventServiceProvider
{
    protected $listen = [
        FcmEvent::class => [FcmEventListener::class,],
        SmsEvent::class => [ SmsEventListener::class,],
        EmailEvent::class => [EmailEventListener::class,]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }
}