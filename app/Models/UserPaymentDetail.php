<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPaymentDetail extends Model
{
    protected $fillable = [
        'user_id',
        'account_type',
        'account_holder_name',
        'iban',
        'account_number',
        'routing_number',
        'code',
        'biccode',
    ];
    public function user() 
    {
        return $this->belongsTo(User::class);
    }
}
