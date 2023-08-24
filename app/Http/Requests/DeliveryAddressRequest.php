<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeliveryAddressRequest extends MinimallRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        $rules = [
            'address1' => 'required|string',
            'address2' => 'sometimes',
            'building_no' => 'nullable',
            'landmark' => 'required|string',
            'zipcode' => 'required|digits:6',
            'city_id' => 'nullable|numeric',
            'state_id' => 'nullable|numeric',
            'country_id' => 'nullable|numeric',
            'type' => 'nullable|string|in:home,office,shop',
            'is_primary' => 'nullable|numeric|in:0,1',
            'status' => 'nullable|numeric|in:0,1',
        ];

        return $rules;
    }
}
