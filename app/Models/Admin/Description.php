<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Description extends Model
{
    protected $fillable = [
        'listing_id',
        'description',
        'language',
    ];
}
