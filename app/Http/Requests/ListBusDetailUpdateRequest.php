<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ListBusDetailUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'model' => ['required'],
            'color' => ['required'],
            'manufacturing_year' => ['required', 'integer'],
            'wifi' => ['boolean'],
            'ac' => ['boolean'],
            'dinner' => ['boolean'],
            'about_the_bus' => ['required'],
            'essentials' => ['required'],
            'snacks' => ['required'],
            'safety_features' => ['required'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
