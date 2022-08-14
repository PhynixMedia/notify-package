<?php

namespace Notify\App;

use App\Providers\EventServiceProvider;
use Notify\App\EventListeners\ReminderEventListener;
use Notify\App\EventListeners\AutorunEventListener;
use Notify\App\EventListeners\InvoiceDueEventListener;

class NotifyEventServiceProvider extends EventServiceProvider
{
    protected $listen = [
        InvoiceDueEvent::class => [AutorunEventListener::class,],
        ReminderEvent::class => [ InvoiceDueEventListener::class,],
        AutoRunEvent::class => [ReminderEventListener::class,]
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