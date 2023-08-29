<?php
namespace App\Http\Requests;

use Astrotomic\Translatable\Validation\RuleFactory;

class ChallengeRequest extends MinimallRequest
{
    protected $redirect = 'challenge/create';

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
            '%title%' => 'required|string',
            '%description%' => 'required|string',
            'video_link' => 'required|string',
            'image' => 'required|string',
            'status' => 'required|boolean',
        ]);

        return $rules;
    }

    public function attributes()
    {
        return [
            'en.title' => 'title (EN)',
            'bg.title' => 'title (BG)',
            'en.description' => 'description (EN)',
            'bg.description' => 'description (BG)',
            'video_link' => 'video link',
            'image' => 'image',
            'status' => 'status',
        ];
    }

    public function messages()
    {
        $messages = [
            'required' => 'Challenge :attribute is required.',
            'boolean' => 'Challenge :attribute must be a boolean value.',
        ];
        return $messages;
    }
}
