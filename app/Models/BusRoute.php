<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BusRoute extends Model
{
    protected $fillable = [
        'origin',
        'destination',
        'distance',
        'duration',
        'pickup_service_id',
        'start_date',
        'end_date',
    ];

    public function pickupService(): BelongsTo
    {
        return $this->belongsTo(PickupService::class);
    }


    public function bus(): HasMany
    {
        return $this->hasMany(Bus::class);
    }
}
