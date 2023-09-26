<?php

namespace App\Events;

use App\Models\Message;
use App\Models\Recipient;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class MessageCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var \App\Models\Message
     */
    public $message;
    public $recipient;

    /**
     * Create a new event instance.
     *
//     * @param \App\Models\Message $message
//     * @param \App\Models\Recipient $recipient
     *
     * @return void
     */
    public function __construct(Message $message, $recipient)
    {
        $this->message = $message;
        $this->recipient = $recipient;
    }


    public function broadcastOn()
    {
        return new PresenceChannel('Messenger.'.$this->recipient);
    }

    public function broadcastAs()
    {
        return 'new-message';
    }
}
