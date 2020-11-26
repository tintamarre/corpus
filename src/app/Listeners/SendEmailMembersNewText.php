<?php

namespace App\Listeners;

use App\Events\NewTextEvent;

class SendEmailMembersNewText
{
    /**
     * Handle the event.
     *
     * @param  NewTextEvent  $event
     * @return void
     */
    public function handle(NewTextEvent $event)
    {
        //
    }
}
