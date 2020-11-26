<?php

namespace App\Mail;

use App\Events\UserAddedToCollectionEvent;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserAddedToCollection extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(UserAddedToCollectionEvent $event)
    {
        $this->event = $event;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.user-added-to-collection')
        ->subject('[' . config('app.name') . '] Welcome to collection')
        ->with('event', $this->event);
    }
}
