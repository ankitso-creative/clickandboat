<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserExprience extends Model
{
    protected $fillable = [
        'user_id',
        'level',
        'prefer',
        'boat_licence',
        'other',
        'sailing_experience',
        'description',
    ];
    public function user() 
    {
        return $this->belongsTo(User::class);
    }
}
