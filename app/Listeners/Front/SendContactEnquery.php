<?php

namespace App\Listeners\Front;

use App\Events\Front\ContactEnquery;
use App\Mail\Front\ContactMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendContactEnquery
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
    public function handle(ContactEnquery $event): void
    {
         Mail::to('ankit@so-creative.co.uk')->send(new ContactMail($event));
    }
}
