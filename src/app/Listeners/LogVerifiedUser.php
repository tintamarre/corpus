<?php

namespace App\Listeners;

use App\Providers\Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Log;

class LogVerifiedUser
{
    /**
     * Handle the event.
     *
     * @param  Verified  $event
     * @return void
     */
    public function handle(Verified $event)
    {
        Log::info('User ' . $event->user->name . ' has been verified.');
    }
}
