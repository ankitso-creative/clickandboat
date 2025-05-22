<?php

namespace App\Models;

use App\Models\Admin\Listing;
use Illuminate\Database\Eloquent\Model;

class ListingReview extends Model
{
    protected $fillable = [
        'listing_id',
        'user_id',
        'rate',
        'review',
    ];
    public function listing() 
    {
        return $this->belongsTo(Listing::class);
    }
}
