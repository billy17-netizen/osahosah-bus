<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Bus extends Model
{
    protected $fillable = [
        'id', // Add this line
        'bus_number',
        'capacity',
        'bus_name',
        'image_url',
        'price_per_seat',
        'status',
    ];

    public function busDetail(): HasOne
    {
        return $this->hasOne(BusDetail::class);
    }

    public function galleryBus(): HasMany
    {
        return $this->hasMany(GalleryBus::class);
    }

    public function seatConfiguration(): HasMany
    {
        return $this->hasMany(SeatConfig::class);
    }

    public function busAvailability(): HasMany
    {
        return $this->hasMany(BusAvailability::class);
    }
}
