<?php

namespace Notify\App\EventListeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Notify\App\Events\AutoRunEvent;
use Notify\App\Services\Email\EmailService;

class EmailEventListener
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
     * @param  AutoRunEvent  $event
     * @return void
     */
    public function handle(AutoRunEvent $event)
    {
        \Log::info("Changes to test event");

        /** * use this method  */
        (new EmailService())->runMany($event->data);
    }
}
