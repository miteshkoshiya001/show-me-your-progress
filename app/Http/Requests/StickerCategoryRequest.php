<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Astrotomic\Translatable\Validation\RuleFactory;

class StickerCategoryRequest extends MinimallRequest
{
    protected $redirect = 'sticker-category/create'; // Adjust the redirect URL

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = RuleFactory::make([
            '%name%' => 'required|string',
        ]);

        // Add any additional rules here if needed

        return $rules;
    }

    public function attributes()
    {
        return [
            'en.name' => 'name (EN)',
            'bg.name' => 'name (BG)',
        ];
    }

    public function messages()
    {
        $messages = [
            'required' => 'Sticker category :attribute is required.',
        ];

        // Add any additional messages here if needed

        return $messages;
    }
}
