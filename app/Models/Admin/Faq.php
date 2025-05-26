<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $table = 'faqs';
    protected $fillable = [
        'question',
        'answer',
        'language',
        'status',
    ];
}
