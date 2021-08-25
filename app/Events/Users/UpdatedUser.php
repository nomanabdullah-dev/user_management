<?php

namespace App\Events\Users;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class UpdatedUser
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $updated_by;
    public $updated_at;

    public function __construct($user)
    {
        $this->user = $user;
        $this->updated_by = Auth::user() ?? null;
        $this->updated_at = date('F d, Y @ H:i:s');
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
