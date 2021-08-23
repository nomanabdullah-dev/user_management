<?php

namespace App\Listeners\Users\Logs;

use App\Events\Users\DeletingUser;
use App\Models\UserLog;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogDeletingUser
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
     * @param  DeletingUser  $event
     * @return void
     */
    public function handle(DeletingUser $event)
    {
        UserLog::create([
            'user_id'   => $event->user->id,
            'slug'      => 'deleted_user',
            'message'   => "Deleted user: {$event->user->name} by: " . ($event->deleted_by->name ?? "Not Found") . " on: {$event->deleted_at}",
            'metadata'  => ['user' => $event->user, 'deleted_by' => $event->deleted_by, 'deleted_at' => $event->deleted_at]
        ]);
        return true;
    }
}
