<?php

namespace App\Http\Requests;

use App\Http\Requests\MinimallRequest;
use Illuminate\Foundation\Http\FormRequest;

class ChallengeUpdateRequest extends MinimallRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize():bool
    {
        return true;
    }

    public function rules():array
    {
        return [
            'title' => 'required|string',
            'description' => 'required|string',
            'video_link' => 'required|string',
            'image' => 'string',
            'status' => 'sometimes|in:0,1',
            'member_ids' => 'sometimes|array',
            'member_ids.*' => 'exists:app_users,id', // Ensure member IDs are valid user IDs
        ];
    }
}
