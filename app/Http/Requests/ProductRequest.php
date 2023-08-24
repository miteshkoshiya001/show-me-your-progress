<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Astrotomic\Translatable\Validation\RuleFactory;

class ProductRequest extends MinimallRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    protected $redirect = 'product/create';

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
        $rules = RuleFactory::make([
            '%title%' => 'required|string',
            '%description%' => 'required',
        ]);
        $rules = array_merge($rules, [
            'category_id' => 'required|numeric',
            'uom_id' => 'required|numeric',
            'stock' => 'required|numeric',
            'price' => 'required',
            'actual_price' => 'required',
            'fake_price' => 'sometimes',
            'user_discount' => 'sometimes',
            'unit_number'=> 'required',
        ]);
        return $rules;
    }

    public function attributes()
    {
        return [
            'en.title' => 'title (EN)',
            'gu.title' => 'title (GU)',
            'en.description' => 'description (EN)',
            'gu.description' => 'description (GU)',
            'uom_id' => 'Unit',
        ];
    }

    public function messages()
    {
        $messages = [
            'required' => 'Product :attribute is required.',
        ];
        return $messages;
    }
}
