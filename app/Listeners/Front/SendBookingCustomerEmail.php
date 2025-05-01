<?php

namespace App\Listeners\Front;

use App\Events\Front\BookingCustomer;
use App\Mail\Front\BookingCustomerMail;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendBookingCustomerEmail
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
    public function handle(BookingCustomer $event): void
    {
        $userEmail = User::where('id',$event->order->user_id)->value('email');
        Mail::to($userEmail)->send(new BookingCustomerMail($event));
    }
}
