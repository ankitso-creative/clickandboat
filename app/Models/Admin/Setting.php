<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Setting extends Model implements HasMedia
{
    use InteractsWithMedia;
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('logo')->singleFile()->useDisk('website_logo'); 
    }
    protected $fillable = [
        'meta_key',
        'meta_value',
    ];
}
