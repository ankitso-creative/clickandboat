<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class OtherListingSetting extends Model
{
    protected $fillable = [
        'listing_id',
        'engine_type',
        'horsepower',
        'width',
        'draft',
        'offshore',
        'crew_members',
        'horsepower_tender',
    ];
    public function listing() 
    {
        return $this->belongsTo(Listing::class);
    }
}
