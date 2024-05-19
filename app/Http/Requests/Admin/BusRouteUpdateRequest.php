<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BusRouteUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'origin' => ['required'],
            'destination' => ['required'],
            'distance' => ['required', 'numeric'],
            'duration' => ['required', 'integer'],
            'pickup_service_id' => ['required', 'integer'],
            'start_date' => ['required'],
            'end_date' => ['required'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
