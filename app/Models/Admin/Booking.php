<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'listing_id',
        'cancellation_conditions',
        'check_in',
        'check_out',
        'check_in_rental',
        'check_out_rental',
        'fuel_cost',
        'boat_licence',
        'night_fees',
    ];
    public function listing() 
    {
        return $this->belongsTo(Listing::class);
    }
}
