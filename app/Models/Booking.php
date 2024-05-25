<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Booking extends Model
{
    protected $fillable = [
        'id', // Add this line
        'user_id',
        'transaction_id', // Add this line
        'booking_date',
        'total_amount',
        'payment_id',
        'status',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function payment(): BelongsTo
    {
        return $this->belongsTo(Payment::class);
    }

    public function bookingDetails(): HasMany
    {
        return $this->hasMany(BookingDetail::class);
    }

    public function customer(): HasMany
    {
        return $this->hasMany(Customer::class);
    }
}
