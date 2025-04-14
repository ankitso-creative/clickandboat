<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class SecurityDeposit extends Model
{
    protected $fillable = [
        'listing_id',
        'security_deposit',
        'type',
        'amount',
    ];
    public function listing() 
    {
        return $this->belongsTo(Listing::class);
    }
}
