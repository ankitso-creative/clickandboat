<?php

namespace App\Models\Admin;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia; 

class Category extends Model implements HasMedia
{
    use InteractsWithMedia;
    protected $fillable = [
        'name',
        'status',
    ];
    public static function boot()
    {
        parent::boot();
        static::saving(function ($category) {
            if (!$category->exists || $category->isDirty('name')) {
                $slug = Str::slug($category->name);
                $existingSlugCount = self::where('slug', 'LIKE', $slug . '%')->where('id', '!=', $category->id)->count();
                if ($existingSlugCount > 0) {
                    $slug = $slug . '-' . ($existingSlugCount + 1);
                }
                $category->slug = $slug;
            }
        });
    }
}
