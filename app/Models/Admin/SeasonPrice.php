<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class SeasonPrice extends Model
{
    protected $fillable = [
        'listing_id',
        'name',
        'from',
        'to',
        'price',
    ];
    public function listing() 
    {
        return $this->belongsTo(Listing::class);
    }
}
