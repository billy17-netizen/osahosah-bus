<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BusDetail extends Model
{
    protected $fillable = [
        'bus_id',
        'model',
        'color',
        'manufacturing_year',
        'wifi',
        'ac',
        'dinner',
        'about_the_bus',
        'essentials',
        'snacks',
        'safety_features',
    ];

    public function bus(): BelongsTo
    {
        return $this->belongsTo(Bus::class);
    }

    public function pickupService(): BelongsTo
    {
        return $this->belongsTo(PickupService::class);
    }
}
