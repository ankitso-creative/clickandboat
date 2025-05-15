<?php

namespace App\Listeners\Front;

use App\Events\Front\RequestSubmitted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\Front\RequestSubmittedMail;
use Illuminate\Support\Facades\Mail;
class SendRequestEmail
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
    public function handle(RequestSubmitted $event): void
    {
        Mail::to('shubham@so-creative.co.uk')->send(new RequestSubmittedMail($event->emailData, $event->file));
    }
}
