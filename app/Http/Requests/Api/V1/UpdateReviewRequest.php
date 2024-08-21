<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateReviewRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'rating' => ['integer', 'required_without_all:body,user_id'],
            'body' => ['string', 'required_without_all:rating,user_id'],
            'user_id' => ['integer', 'exists:users,id', 'required_without_all:rating,body'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'required_without_all' => "At least one field is required ('rating', 'body', 'user_id')."
        ];
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        // $errors = $validator->errors();

        // $response = response()->json([
        //     'message' => 'Invalid data send',
        //     'details' => $errors->messages(),
        // ], 422);
    
        // throw new HttpResponseException($response);

        $response = response()->json([
            'message' => $validator->errors()->first(),

        ]);

        throw new HttpResponseException($response);
    }
}
