<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    protected $fillable = [
        'user_id',
        'listing_id',
        'days',
        'checkin',
        'checkout',
        'net_amount',
        'service_fee',
        'sub_total',
        'total',
        'currency',
        'status',
    ];
}
