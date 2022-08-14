<?php

namespace Notify\App\EventListeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Notify\App\Events\ReminderEvent;
use Notify\App\Services\Sms\SmsService;

class SmsEventListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ReminderEvent  $event
     * @return void
     */
    public function handle(ReminderEvent $event)
    {
        /** * use this method  */
        (new SmsService())->runMany($event->data);
    }
}
