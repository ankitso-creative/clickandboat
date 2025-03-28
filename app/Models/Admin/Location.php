<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia; 

class Location extends Model implements HasMedia
{
    use InteractsWithMedia;
    protected $fillable = [
        'name',
        'description',
        'language',
        'status',
    ];
    public static function boot()
    {
        parent::boot();
        static::saving(function ($location) {
            $slug = Str::slug($location->name);
            $existingSlugCount = self::where('slug', $slug)->count();
            if ($existingSlugCount > 0) {
                $slug = $slug . '-' . ($existingSlugCount + 1);
            }
            $location->slug = $slug;
        });
    }
}
