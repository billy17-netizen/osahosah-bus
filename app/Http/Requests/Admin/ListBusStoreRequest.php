<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ListBusStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'bus_number' => ['required'],
            'capacity' => ['required', 'integer'],
            'bus_name' => ['required'],
            'image_url' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'status' => ['required', 'boolean'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
