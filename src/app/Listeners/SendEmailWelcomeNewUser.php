<?php

namespace App\Listeners;

use App\Events\NewUserRegisteredEvent;

class SendEmailWelcomeNewUser
{
    /**
    * Handle the event.
    *
    * @param  NewUserRegisteredEvent  $event
    * @return void
    */
    public function handle(NewUserRegisteredEvent $event)
    {
        //
    }
}
