<?php

namespace App\Listeners\Admin;

use App\Events\Admin\ListingApprove;
use App\Mail\Admin\ListingApproveEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendListingApproveEmail
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
    public function handle(ListingApprove $event): void
    {
       Mail::to('contact@myboatbooker.com')->send(new ListingApproveEmail($event->listing));
    }
}
