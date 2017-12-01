<?php

namespace App\Events;

use App\Entities\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class PostMessageToUsersEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    const CHANNEL_NAME = 'message-to-users-channel.';
    const EVENT_NAME = 'message-to-users-event.';

    /**
     * @var User
     *
     * auth user
     */
    protected $user;

    /**
     * @var string
     *
     * posted message
     */
    protected $message;

    /**
     * @var array
     *
     * selected user id to send message
     */
    protected $toUserId;

    /**
     * PostMessageToUsersEvent constructor.
     * @param User $user
     * @param $message
     * @param $toUsers
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
        return new PrivateChannel(self::CHANNEL_NAME . $this->user->group);
    }

    /**
     * @return string
     */
    public function broadcastAs()
    {
        return self::EVENT_NAME . $this->toUserId;
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
        ];
    }
}
