<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'gender',
        'dob',
        'address',
        'address_line_two',
        'city',
        'state',
        'country',
        'postcode',
    ];
    public function user() 
    {
        return $this->belongsTo(User::class);
    }
}
