<?php

namespace App\Http\Requests;

use App\Http\Requests\MinimallRequest;
use Illuminate\Foundation\Http\FormRequest;
use Astrotomic\Translatable\Validation\RuleFactory;
use Illuminate\Validation\Validator;

class TrendingOfferRequest extends MinimallRequest
{
    protected $redirect = 'trending-offer/create';
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
            'title' => 'required|string',
            'banner' => 'mimes:jpeg,png,jpg|max:2048',
        ];
        
        if (!request()->id ) {
            $rules['banner'] = 'required|mimes:jpeg,png,jpg|max:2048';
        }
        return $rules;
    }
}
