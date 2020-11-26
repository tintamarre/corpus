<?php

namespace App\Listeners;

use App\Events\CollectionDeletedEvent;

class SendEmailMembersCollectionDeleted
{
    /**
     * Handle the event.
     *
     * @param  CollectionDeletedEvent  $event
     * @return void
     */
    public function handle(CollectionDeletedEvent $event)
    {
        //
    }
}
