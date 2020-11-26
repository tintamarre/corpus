<?php

namespace App\Listeners;

use App\Events\UserAddedToCollectionEvent;
use App\Mail\UserAddedToCollection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendEmailUserAddedToCollection
{
    /**
    * Handle the event.
    *
    * @param  UserAddedToCollectionEvent  $event
    * @return void
    */
    public function handle(UserAddedToCollectionEvent $event)
    {
        Log::info('User ' . $event->user->name . ' has been added to the collection ' . $event->collection->name);

        Mail::to($event->user->email)->send(new UserAddedToCollection($event));
    }
}
