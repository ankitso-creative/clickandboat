<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    protected $fillable = [
        'listing_id',
        'price',
        'season_price_id',
        'over_night_price',
        'one_half_day',
        'two_day',
        'three_day',
        'four_day',
        'five_day',
        'six_day',
        'one_week',
    ];
    public function listing() 
    {
        return $this->belongsTo(Listing::class);
    }
    public function season() 
    {
        return $this->belongsTo(SeasonPrice::class);
    }
}
