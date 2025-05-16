<?php

namespace App\Listeners\Front;

use App\Events\Front\CancelBooking;
use App\Mail\Front\CancelBookingMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendCancelBookingEmail
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
    public function handle(CancelBooking $event): void
    {
        $email = $event->order->user->email;
        Mail::to($email)->send(new CancelBookingMail($event));
    }
}
