<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PickupDroppingUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'pickup_location' => ['required'],
            'dropping_point' => ['required'],
            'latlong' => ['required'],
            'pickup_fee' => ['required', 'numeric'],
            'pickup_time' => ['required'],
            'dropping_time' => ['required'],
            'status' => ['required', 'boolean'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
