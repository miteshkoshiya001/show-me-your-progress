<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\App;
use App\Http\Requests\MinimallRequest;
use Illuminate\Foundation\Http\FormRequest;

class ChallengeRequest extends MinimallRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize():bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules():array
    {
        $userLanguage = request()->authUserLocale;
        // dd($userLanguage);

        return [
            'title' => 'required|string',
            'description' => 'required|string',
            'video_link' => 'required|string',
            'image' => 'file|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'sometimes|nullable|in:0,1'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => 'Challenge title is required.',
            'description.required' => 'Challenge description is required.',
            'video_link.required' => 'Video link is required.',
            'image.required' => 'Image is required.',
            'status.in' => 'Invalid status value. Must be either 0 or 1.'
        ];
    }
}
