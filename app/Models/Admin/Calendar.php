<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
    protected $fillable = [
        'listing_id',
        'from_date',
        'from_to',
        'reason',
    ];
    public function listing() 
    {
        return $this->belongsTo(Listing::class);
    }
}
