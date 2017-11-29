<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Console\Scheduling\Event;

class PusherEvent implements ShouldBroadcast
{
    const CHANNEL_NAME = 'test-channel';
    const EVENT_NAME = 'test-event';

    use SerializesModels, InteractsWithSockets, Dispatchable;

    public $message;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($message)
    {
        $this->message = $message;
    }

    /**
     * 送信先のチャンネル
     * @return Channel
     */
    public function broadcastOn()
    {
        return new Channel(self::CHANNEL_NAME);
    }

    /**
     * イベント名
     * @return string
     */
    public function broadcastAs()
    {
        return self::EVENT_NAME;
    }
}