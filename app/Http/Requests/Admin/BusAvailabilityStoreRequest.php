<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BusAvailabilityStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'bus_id' => 'required|integer',
            'bus_route_id' => 'required|integer',
            'travel_date' => 'required',
            'available_seats' => 'required|integer',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
