<?php

namespace App\Listeners\Front;

use App\Events\Front\PendingAmountCustomer;
use App\Mail\Front\PendingCustomerMail;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendPayPendingCustomerEmail
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
    public function handle(PendingAmountCustomer $event): void
    {
        $userEmail = User::where('id',$event->order->user_id)->value('email');
        Mail::to($userEmail)->send(new PendingCustomerMail($event));
    }
}
