<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BusAvailability extends Model
{
    protected $fillable = [
        'bus_route_id',
        'bus_id',
        'travel_date',
        'available_seats',
    ];

    public function busRoute(): BelongsTo
    {
        return $this->belongsTo(BusRoute::class);
    }

    public function bus(): BelongsTo
    {
        return $this->belongsTo(Bus::class);
    }


}
