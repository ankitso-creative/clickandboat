<?php

namespace App\Listeners\Front;

use App\Events\Front\CompletedBooking;
use App\Mail\Front\CompleteBookingMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendCompleteBookingEmail
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
    public function handle(CompletedBooking $event): void
    {
        $email = $event->order->user->email;
        Mail::to($email)->send(new CompleteBookingMail($event));
    }
}
