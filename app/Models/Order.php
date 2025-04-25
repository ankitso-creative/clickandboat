<?php

namespace App\Models;

use App\Models\Admin\Listing;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'id', 
        'user_id', 
        'listing_id', 
        'payment_intent_id',
        'rental_type',
        'additional_options',
        'multi_risk',
        'assistance',
        'insured_price',
        'check_in',
        'check_out',
        'sub_total',
        'service_fees',
        'extra_fees',
        'total',
        'amount_paid',
        'pending_amount',
        'cancel_reason',
        'cancel_message',
        'payment_status',
        'currency',
    ];
    public function listing() 
    {
        return $this->belongsTo(Listing::class);
    }
    public function user() 
    {
        return $this->belongsTo(User::class);
    }
}
