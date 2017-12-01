<?php

namespace App\Events;

use App\Entities\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class PostMessageToUserEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    const CHANNEL_NAME = 'message-to-user-channel';
    const EVENT_NAME = 'message-to-user-event';

    protected $user;

    protected $message;

    protected $toUserId;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, $message, $toUserId)
    {
        $this->user = $user;
        $this->message = $message;
        $this->toUserId = $toUserId;
    }

    /**
     * @return Channel
     */
    public function broadcastOn()
    {
        return new PrivateChannel(self::CHANNEL_NAME);
    }

    /**
     * @return string
     */
    public function broadcastAs()
    {
        return self::EVENT_NAME;
    }

    /**
     * @return array
     */
    public function broadcastWith()
    {
        // This must always be an array. Since it will be parsed with json_encode()
        return [
            'user' => $this->user->name,
            'message' => $this->message,
            'toUserId' => $this->toUserId,
        ];
    }
}
