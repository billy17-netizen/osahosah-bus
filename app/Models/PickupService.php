<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PickupService extends Model
{
    protected $fillable = [
        'pickup_location',
        'dropping_point',
        'latlong',
        'pickup_fee',
        'pickup_time',
        'dropping_time',
        'status',
    ];
}
