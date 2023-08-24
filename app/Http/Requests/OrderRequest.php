<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends MinimallRequest
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
        return [
            'basket' => 'required|array',
            'basket.*.product_id' => 'required|integer',
            'basket.*.quantity' => 'required|integer|min:1',
            'basket.*.price' => 'required|numeric|min:0',
            'basket.*.item_total' => 'required|numeric|min:0',
            'basket.*.category_id' => 'required|integer',
            'basket.*.unit_id' => 'required|integer',
            'address_id' => 'required|integer',
            'order_note' => 'nullable|string',
            'order_total' => 'required|numeric|min:0',
            'status' => 'required|integer',
        ];
    }
}
