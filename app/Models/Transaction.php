<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'id', 
        'order_id', 
        'transactions_id', 
        'amount_paid',
        'payment_status',
    ];
}
