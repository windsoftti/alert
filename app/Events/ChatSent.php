<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Prospecto;
use App\Chat;

class ChatSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Prospecto that sent the message
     *
     * @var Prospecto
     */
    public $prospecto;

    /**
     * Chat details
     *
     * @var Chat
     */
    public $chat;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Prospecto $prospecto, Chat $chat)
    {
        $this->prospecto = $prospecto;
        $this->chat = $chat;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        // return new PrivateChannel('my-channel');
        return ['my-channel'];
    }


    public function broadcastAs()
    {
        return 'chat-sent';
    }
}
