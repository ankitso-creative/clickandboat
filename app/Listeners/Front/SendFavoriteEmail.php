<?php

namespace App\Listeners\Front;

use App\Events\Front\AddFavorite;
use App\Mail\Front\FavoriteMail;
use App\Models\Admin\Listing;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
class SendFavoriteEmail
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
    public function handle(AddFavorite $event): void
    {
        $listing = Listing::where('id', $event->favorite->listing_id)->first();
        Mail::to($listing->user->email)->send(new FavoriteMail($event));
        //Mail::to('')->send(new FavoriteMail());
    }
}
