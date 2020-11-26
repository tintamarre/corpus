<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewTextEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $text;

    /**
    * Create a new event instance.
    *
    * @return void
    */
    public function __construct($user, $text)
    {
        $this->user = $user;
        $this->text = $text;
    }
}
