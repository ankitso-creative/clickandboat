<?php

namespace App\Listeners\Front;

use App\Events\Front\PendingAmountOwner;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\Front\PendingOwnerMail;
use App\Models\Admin\Listing;
use Illuminate\Support\Facades\Mail;

class SendPayPendingOwnerEmail
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
    public function handle(PendingAmountOwner $event): void
    {
        $listing = Listing::with('user')->where('id',$event->order->listing_id)->first();
        Mail::to($listing->user->email)->send(new PendingOwnerMail($event));
    }
}
