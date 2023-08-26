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
        if (!empty(request()->get('authUserId'))) {
            return [
                'first_name' => 'required|max:255',
                'last_name' => 'required|max:255',
                'username' => 'required|unique:app_users,username,' . request()->get('authUserId') . ',id',
                'email' => 'sometimes|email|unique:app_users,email,' . request()->get('authUserId') . ',id',
                'phone' => 'sometimes|digits:10|unique:app_users,phone,'  . request()->get('authUserId') . ',id',
                'user_category_id' => 'sometimes|numeric', // Adjust this rule as needed
                'referral_code' => 'sometimes|string|unique:app_users,referral_code,' . request()->get('authUserId') . ',id',
                'password' => 'sometimes|min:8', // Adjust the rule for password as needed
                'avatar' => 'sometimes|image|mimes:jpeg,png,jpg',
                'language' =>'sometimes|max:255'
            ];
        }
        return [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'phone' => 'sometimes|digits:10|unique:app_users,phone',
            'email' => 'sometimes|email|unique:app_users,email',
            'username' => 'required|unique:app_users,username,',
            'user_category_id' => 'sometimes', // Adjust this rule as needed
            'referral_code' => 'sometimes|string',
            'password' => 'required|min:8', // Adjust the rule for password as needed
            'avatar' => 'sometimes|image|mimes:jpeg,png,jpg',
            'parent_id' => 'sometimes|numeric|exists:app_users,id', // Adjust this rule as needed
            'language' =>'sometimes|max:255'
        ];
    }
}
