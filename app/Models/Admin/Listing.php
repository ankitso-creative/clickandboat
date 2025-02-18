<?php

namespace App\Models\Admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Price;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Support\Str;

class Listing extends Model implements HasMedia
{
    use InteractsWithMedia;
    protected $fillable = [
        'user_id',
        'type',
        'harbour',
        'city',
        'professional',
        'manufacturer',
        'model',
        'skipper',
        'capacity',
        'length',
        'company_name',
        'website',
        'boat_name',
        'title',
        'description',
        'onboard_capacity',
        'cabins',
        'berths',
        'bathrooms',
        'construction_year',
        'fuel',
        'renovated',
        'speed',
    ];
    public function user() 
    {
        return $this->belongsTo(User::class);
    }
    public function price() 
    {
        return $this->hasOne(Price::class);
    }
    public function booking() 
    {
        return $this->hasOne(Booking::class);
    }
    public function otherListingSetting() 
    {
        return $this->hasOne(OtherListingSetting::class);
    }
    public function equipment() 
    {
        return $this->hasOne(Equipment::class);
    }
    public function discount() 
    {
        return $this->hasOne(Discount::class);
    }
    public function calendar()
    {
        return $this->hasMany(Calendar::class);
    }
    public static function boot()
    {
        parent::boot();
        static::saving(function ($listing) {
            $slug = Str::slug($listing->boat_name);
            $existingSlugCount = self::where('slug', $slug)->count();
            if ($existingSlugCount > 0) {
                $slug = $slug . '-' . ($existingSlugCount + 1);
            }
            $listing->slug = $slug;
        });
    }
}
