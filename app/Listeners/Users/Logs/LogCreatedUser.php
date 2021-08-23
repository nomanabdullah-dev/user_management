<?php

namespace App\Listeners\Users\Logs;

use App\Events\Users\CreatedUser;
use App\Models\UserLog;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogCreatedUser
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  CreatedUser  $event
     * @return void
     */
    public function handle(CreatedUser $event)
    {
        UserLog::create([
            'user_id'   => $event->user->id,
            'slug'      => 'created_user',
            'message'   => "Created user: {$event->user->name} by: " . ($event->created_by->name ?? "Not Found") . " on: {$event->created_at}",
            'metadata'  => ['user' => $event->user, 'created_by' => $event->created_by, 'created_at' => $event->created_at]
        ]);
        return true;
    }
}
