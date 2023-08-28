<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Astrotomic\Translatable\Validation\RuleFactory;

class StickerCollectionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = RuleFactory::make([
            '%name%' => 'required|string',
        ]);
        $rules['sticker_category_id'] = 'required|exists:sticker_categories,id';
        return $rules;
    }

    public function attributes()
    {
        return [
            'en.name' => 'name (EN)',
            'bg.name' => 'name (BG)',
            'sticker_category_id' => 'sticker category',
        ];
    }

    public function messages()
    {
        $messages = [
            'required' => 'Sticker category :attribute is required.',
            'exists' => 'Selected :attribute does not exist.',
        ];

        return $messages;
    }
}
