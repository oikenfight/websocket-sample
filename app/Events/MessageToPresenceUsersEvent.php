<?php

namespace App\Events;

use App\Entities\Message;
use App\Entities\MessageManagement;
use App\Entities\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class MessageToPresenceUsersEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    const CHANNEL_NAME = 'presence-user-channel';
    const EVENT_NAME = 'message-to-presence-users-event.';

    /**
     * @var User
     *
     * auth user
     */
    protected $user;

    /**
     * @var
     */
    protected $message;

    /**
     * @var array
     *
     * selected user id to send message
     */
    protected $toUserId;

    /**
     * @var MessageManagement
     */
    protected $messageManagement;

    /**
     * PostMessageToUsersEvent constructor.
     * @param User $user
     * @param $message
     * @param $toUsers
     */
    public function __construct(User $user, $message, $toUserId, MessageManagement $messageManagement)
    {
        $this->user = $user;
        $this->message = $message;
        $this->toUserId = $toUserId;
        $this->messageManagement = $messageManagement;
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
        return self::EVENT_NAME . $this->toUserId;
    }

    /**
     * @return array
     */
    public function broadcastWith()
    {
        // This must always be an array. Since it will be parsed with json_encode()
        return [
            'fromUser' => $this->user, // auth user
            'message' => $this->message, // message
            'messageManagementId' => $this->messageManagement->id,
            'readStatus' => false,
        ];
    }
}
