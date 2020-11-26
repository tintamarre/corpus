<?php

namespace App\Listeners;

use App\Events\UserBecameAdminToCollectionEvent;
use Illuminate\Support\Facades\Log;

class SendEmailUserBecameAdminToCollection
{
    /**
     * Handle the event.
     *
     * @param  UserBecameAdminToCollectionEvent  $event
     * @return void
     */
    public function handle(UserBecameAdminToCollectionEvent $event)
    {
        Log::info('User ' . $event->user->name . ' has been promoted admin to the collection ' . $event->collection->name);
    }
}
