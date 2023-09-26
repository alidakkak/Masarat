<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreEmergencyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'services' => 'required|string',
            'image' => 'image|mimes:jpg,png,jpeg|max:2048',
            'maintenance_technician_ids' => 'array',
            'maintenance_technician_ids.*' => [Rule::exists('maintenance_technicians' , 'id')]
        ];
    }
}
