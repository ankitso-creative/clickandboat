<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia; 
use Spatie\MediaLibrary\InteractsWithMedia;
class UserCompany extends Model implements HasMedia
{
    use InteractsWithMedia;
    protected $fillable = [
        'user_id',
        'company_name',
        'address',
        'siret',
        'intracommunity_vat',
        'website',
        'booking_management_system',
    ];
    public function user() 
    {
        return $this->belongsTo(User::class);
    }
}
