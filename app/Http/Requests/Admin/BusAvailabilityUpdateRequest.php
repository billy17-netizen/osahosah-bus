<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BusAvailabilityUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'bus_id' => 'required',
            'bus_route_id' => 'required',
            'travel_date' => 'required',
            'available_seats' => 'required|integer',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
