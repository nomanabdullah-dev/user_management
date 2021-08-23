<?php

namespace App\Listeners\Users\Logs;

use App\Events\Users\DeletingUser;
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
        //
    }
}
