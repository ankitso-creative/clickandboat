<?php

namespace App\Listeners\Auth;

use App\Events\Auth\UserRegistered;
use App\Mail\Auth\UserRegisterEmail;
use App\Mail\Auth\UserRegisterAdminEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendWelcomeEmail
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
    public function handle(UserRegistered $event): void
    {
        Mail::to('shubham@so-creative.co.uk')->send(new UserRegisterAdminEmail($event->user));
        Mail::to($event->user->email)->send(new UserRegisterEmail($event->user));
    }
}
