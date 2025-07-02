<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewChatCreate implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $chat;
    protected $userId;

    public function __construct($chat, $user_id)
    {
        $this->chat = $chat;
        $this->userId = $user_id;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('user.' . $this->userId . '.new-chat-create');
    }

    public function broadcastWith()
    {
        return $this->chat->toArray();
    }
}

