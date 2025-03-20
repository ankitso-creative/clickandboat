<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class BlogComment extends Model
{
    protected $fillable = [
        'blog_id',
        'name',
        'email',
        'website',
        'message',
        'status',
    ];
    public function comments() 
    {
        return $this->belongsTo(Blog::class);
    }
}
