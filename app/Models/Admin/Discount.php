<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $fillable = [
        'listing_id',
        'first_booking_discount',
        'early_bird_discount',
        'last_minute_booking',
        'length_of_stay_discounts',
        'custom_discounts',
    ];
    public function listing() 
    {
        return $this->belongsTo(Listing::class);
    }
}
