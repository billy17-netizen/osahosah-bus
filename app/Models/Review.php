<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'booking_id',
        'bus_id',
        'punctuality_rating',
        'services_staff_rating',
        'cleanliness_rating',
        'comfort_rating',
        'comment',
        'is_approved',
        'approved_at',
        'rejected_at',
        'rejected_reason',
    ];

    protected $casts = [
        'is_approved' => 'integer', // 0: rejected, 1: approved, 2: pending
        'approved_at' => 'datetime',
        'rejected_at' => 'datetime',
    ];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function bus(): BelongsTo
    {
        return $this->belongsTo(Bus::class);
    }

    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class);
    }

    public function getAverageRatingAttribute(): float
    {
        return ($this->punctuality_rating + $this->services_staff_rating + $this->cleanliness_rating + $this->comfort_rating) / 4;
    }

    public function getHighestRatingAttribute(): string
    {
        $ratings = [
            'punctuality_rating' => $this->punctuality_rating,
            'services_staff_rating' => $this->services_staff_rating,
            'cleanliness_rating' => $this->cleanliness_rating,
            'comfort_rating' => $this->comfort_rating,
        ];

        // Get the key (category name) of the maximum value
        $highestRatingCategory = array_search(max($ratings), $ratings);

        return $highestRatingCategory; // return only the first category with the highest rating
    }

}
