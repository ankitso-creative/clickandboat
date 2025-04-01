<?php

namespace App\Models;

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
        'payment_status',
    ];

}
