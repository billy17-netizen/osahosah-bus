<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ListBusUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        $rules = [
            'bus_number' => ['required'],
            'capacity' => ['required', 'integer'],
            'bus_name' => ['required'],
            'status' => ['required', 'boolean'],
        ];

        if ($this->getMethod() == 'POST') {
            $rules += ['image_url' => ['required']];
        }

        return $rules;
    }

    public function authorize(): bool
    {
        return true;
    }
}
