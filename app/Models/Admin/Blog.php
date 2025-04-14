<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia; 
class Blog extends Model implements HasMedia
{
    use InteractsWithMedia;
    protected $fillable = [
        'title',
        'description',
        'language',
        'read_minutes',
        'order_by',
    ];
    public static function boot()
    {
        parent::boot();
        static::saving(function ($blog) {
            $slug = Str::slug($blog->title);
            $existingSlugCount = self::where('slug', $slug)->count();
            if ($existingSlugCount > 0) {
                $slug = $slug . '-' . ($existingSlugCount + 1);
            }
            $blog->slug = $slug;
        });
    }
    public function comments() 
    {
        return $this->hasMany(BlogComment::class);
    }
}
