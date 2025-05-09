<?php

namespace App\Models;

use App\Models\Admin\Listing;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'sender_id',
        'receiver_id',
        'listing_id',
        'message',
        'image',
    ];
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
    public function listing()
    {
        return $this->belongsTo(Listing::class, 'listing_id');
    }
}
