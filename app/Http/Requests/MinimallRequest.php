<?php

namespace App\Http\Requests;

use Illuminate\Http\JsonResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;

class MinimallRequest extends FormRequest
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
        return [
            //
        ];
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();
        
        $formattedError = [];
        if (!empty($errors)) {
            foreach ($errors as $key => $error) {
                $formattedError[$key] = implode(", ", $error);
            }
        }
        if (request()->ajax() || request()->wantsJson() || request()->acceptsJson()) {
            throw new HttpResponseException(
                response()->json(
                    [
                        'code' => JsonResponse::HTTP_UNPROCESSABLE_ENTITY,
                        'status' => false,
                        'message' => current($formattedError)
                    ],
                    JsonResponse::HTTP_UNPROCESSABLE_ENTITY
                )
            );
        }

        return redirect()->to($this->getRedirectUrl())
                    ->withInput(request()->input())
                    ->withErrors($errors);
    }
}
