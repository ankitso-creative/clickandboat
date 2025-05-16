<?php

namespace App\Models;

use App\Models\Admin\Listing;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia; 

class Order extends Model implements HasMedia
{
    use InteractsWithMedia;
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
        'discount',
    ];
    public function listing() 
    {
        return $this->belongsTo(Listing::class);
    }
    public function user() 
    {
        return $this->belongsTo(User::class);
    }
    public function transaction()
    {
        return $this->hasMany(Transaction::class);
    }
}
