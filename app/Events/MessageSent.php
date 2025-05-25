<?php

namespace App\Events;

use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $user;

    public function __construct($message, $user)
    {
        $this->message = $message;
        $this->user = $user;
    }

    // Kênh riêng, chỉ người dùng được quyền mới nghe
    public function broadcastOn()
    {
        return new PrivateChannel('chat');
    }

    // Dữ liệu gửi đến phía frontend (JS)
    public function broadcastWith()
    {
        return [
            'message' => $this->message,
            'user' => [
                'id' => $this->user->id,
                'name' => $this->user->name,
            ],
        ];
    }

    // Tên sự kiện gửi đi
    public function broadcastAs()
    {
        return 'message.sent';
    }
}
