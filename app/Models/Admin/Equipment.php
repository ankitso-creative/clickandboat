<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    protected $table = 'equipments';
    protected $fillable = [
        'listing_id',
        'outdoor_equipment',
        'extra_comfrot',
        'navigation_equipment',
        'kitchen',
        'leisure_activities',
        'onboard_energy',
        'water_sports',
    ];
    public function listing() 
    {
        return $this->belongsTo(Listing::class);
    }
}
