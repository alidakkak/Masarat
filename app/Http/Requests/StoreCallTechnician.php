<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCallTechnician extends FormRequest
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
            'customer_name' => 'required|string',
            'floor_number' => 'required',
            'apartment_number' => 'required',
            'problems_evel' => 'required',
            'problems_descrption' => 'required',
             'maintenance_technician_id' => ['required',
              Rule::exists('maintenance_technicians', 'id')],
              'emergency_id' => ['required' , Rule::exists('emergencies' , 'id')]

        ];
    }
}
