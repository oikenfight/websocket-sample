<?php

namespace App\Events;

use App\Entities\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class PresenceUserEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    const CHANNEL_NAME = 'presence-user-channel';
    const EVENT_NAME = 'presence-user-event';

    /**
     * @var User
     */
    protected $user;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @return Channel
     */
    public function broadcastOn()
    {
        return new PresenceChannel(self::CHANNEL_NAME);
    }

    /**
     * @return string
     */
    public function broadcastAs()
    {
        return self::EVENT_NAME;
    }
}
