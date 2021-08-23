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

class DeletingUser
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $deleted_by;
    public $deleted_at;

    public function __construct($user)
    {
        $this->user = $user;
        $this->deleted_by = Auth::user() ?? null;
        $this->deleted_at = date('F d, y @ H:i:s');

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
