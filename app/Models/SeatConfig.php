<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SeatConfig extends Model
{
    protected $fillable = ['bus_id', 'code', 'status'];

    public function bus(): BelongsTo
    {
        return $this->belongsTo(Bus::class);
    }
}
