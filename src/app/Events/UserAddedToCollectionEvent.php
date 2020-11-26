<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserAddedToCollectionEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $collection;

    /**
    * Create a new event instance.
    *
    * @return void
    */
    public function __construct($user, $collection)
    {
        $this->user = $user;
        $this->collection = $collection;
    }
}
