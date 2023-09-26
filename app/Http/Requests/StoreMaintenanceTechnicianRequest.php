<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreMaintenanceTechnicianRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'email' => 'required|email|unique:maintenance_technicians,email',
            'password' => 'required|min:7',
            'image'  => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
            'stuts' => 'required|string',
        ];
    }
}
