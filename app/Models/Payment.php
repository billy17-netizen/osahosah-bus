<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'payment_method',
        'va_number',
        'amount',
        'payment_status',
        'payment_date',
    ];
}
