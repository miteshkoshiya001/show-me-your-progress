<?php

namespace App\Http\Requests;

use App\Http\Requests\MinimallRequest;
use Illuminate\Foundation\Http\FormRequest;

class AppUserRequest extends MinimallRequest
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
        if(!empty(request()->get('authUserId'))){
            return [
                'name' => 'required|max:255',
                'phone' => 'required|digits:10|unique:app_users,phone,'.request()->get('authUserId').',id',
                'email' => 'sometimes|email|unique:app_users,email,'.request()->get('authUserId').',id',
                'avatar' => 'sometimes|image|mimes:jpeg,png,jpg',
            ];
        }
        return [
            'name' => 'required|max:255',
            'password' => 'required',
            'phone' => 'required|digits:10',
            'email' => 'sometimes|email',
            'status' => 'required|in:0,1,2|numeric',
            'avatar' => 'sometimes|image|mimes:jpeg,png,jpg',
            'language' => 'required|in:en,gu',
            'plain_pass' => 'sometimes',
            'user_type' => 'sometimes',
        ];
    }
}
