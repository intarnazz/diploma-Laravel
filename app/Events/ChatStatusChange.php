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

class ChatStatusChange implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $data;
    public $chatId;

    public function __construct($data)
    {
        $this->data = $data;
        $this->chatId = $data->id;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('chat-status.' . $this->chatId);
    }

    public function broadcastWith()
    {
        return  $this->data->toArray();
    }
}

