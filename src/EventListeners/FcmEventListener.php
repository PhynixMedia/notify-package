<?php

namespace Notify\App\EventListeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Notify\App\Events\InvoiceDueEvent;
use Notify\App\Services\Fcm\FcmService;

class FcmEventListener
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
     * @param  InvoiceDueEvent  $event
     * @return void
     */
    public function handle(InvoiceDueEvent $event)
    {
        /** * use this method  */
        (new FcmService())->runMany($event->data);
    }
}
