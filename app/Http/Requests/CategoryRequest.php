<?php

namespace App\Http\Requests;

use Astrotomic\Translatable\Validation\RuleFactory;

class CategoryRequest extends MinimallRequest
{
    protected $redirect = 'category/create';

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
        $rules = RuleFactory::make([
            '%name%' => 'required|string',
        ]);
        if (request()->id == 0 && request()->has('image') == false) {
            $rules['image'] = 'required|image|mimes:jpeg,png,jpg|max:2048';
        }
        return $rules;
    }

    public function attributes()
    {
        return [
            'en.name' => 'name (EN)',            
            'gu.name' => 'name (GU)',            
            'image' => 'image',            
        ];
    }

    public function messages()
    {
        $messages = [
            'required' => 'Category :attribute is required.',
        ];
        if (request()->id == 0 && request()->has('image') == false) {
            $messages['image.required'] = 'Category :attribute is required.';
        }
        return $messages;
    }
}
