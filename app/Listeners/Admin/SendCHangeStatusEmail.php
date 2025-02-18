<?php

namespace App\Listeners\Admin;

use App\Events\Admin\UserChangeStatus;
use App\Mail\Admin\UserChangeStatusEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendCHangeStatusEmail
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserChangeStatus $event): void
    {
       Mail::to($event->user->email)->send(new UserChangeStatusEmail($event->user));
    }
}
