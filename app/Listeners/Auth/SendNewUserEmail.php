<?php

namespace App\Listeners\Auth;

use App\Events\Auth\NewUserRegistered;
use App\Mail\Auth\NewUserRegisterEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use League\CommonMark\Renderer\Inline\NewlineRenderer;

class SendNewUserEmail
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
    public function handle(NewUserRegistered $event): void
    {
        Mail::to($event->user->email)->send(new NewUserRegisterEmail($event->user));
    }
}
