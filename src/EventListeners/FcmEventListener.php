<?php

namespace Notify\App\EventListeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Notify\App\Events\FcmEvent;
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
     * @param  FcmEvent  $event
     * @return void
     */
    public function handle(FcmEvent $event)
    {
        /** * use this method  */
        (new FcmService())->runMany($event->data);
    }
}
