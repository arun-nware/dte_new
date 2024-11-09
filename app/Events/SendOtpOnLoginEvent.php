<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SendOtpOnLoginEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public mixed $user;

    /**
     * Create a new event instance.
     */
    public function __construct($user)
    {
        $this->user = $user;

    }

}
