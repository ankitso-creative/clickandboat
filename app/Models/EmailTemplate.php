<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class EmailTemplate extends Model
{
    protected $fillable = [
        'title',
        'subject',
        'description',
        'slug',
        'who_receive',
    ];
    public static function boot()
    {
        parent::boot();
        static::saving(function ($emailTemplate) {
            $slug = Str::slug($emailTemplate->title);
            $existingSlugCount = self::where('slug', $slug)->count();
            if ($existingSlugCount > 0) {
                $slug = $slug . '-' . ($existingSlugCount + 1);
            }
            $emailTemplate->slug = $slug;
        });
    }
}
