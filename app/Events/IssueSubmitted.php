<?php

namespace App\Events;

use App\Models\Issues;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class IssueSubmitted implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $issue; // Property to hold the issue data

    /**
     * Create a new event instance.
     *
     * @param Issues $issue
     */
    public function __construct(\App\Models\Issues $issue)
    {
        $this->issue = $issue; // Assign the issue data
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('issues'), // Change to a public channel
        ];
    }
}
