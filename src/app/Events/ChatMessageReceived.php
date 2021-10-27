<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ChatMessageReceived implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    protected $message;
    protected $request;
    public function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('tech_match');
    }
    public function broadcastWith()
    {
        return [
            'message' => $this->request['message'],
            'send' => $this->request['send'],
            'receive' => $this->request['receive'],
            'time' => $this->request['time'],
            'icon' => $this->request['icon'],
        ];
    }

    public function broadcastAs()
    {
        return 'chat_event';
    }
}
