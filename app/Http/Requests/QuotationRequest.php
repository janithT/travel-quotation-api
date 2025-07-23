<?php

namespace App\Http\Requests;

use App\Models\Ageload;
use App\Rules\ValidAgeGroup;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class QuotationRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Prepare the age for validation if string.
     */
    protected function prepareForValidation()
    {
        if (is_string($this->age)) {
            
            $expAges = explode(',', $this->age);

            $ages = array_filter($expAges, function ($val) {
                    return $val !== '';
                }
            );

            $ages = array_map('intval', $ages);

            $this->merge([
                'age' => $ages,
            ]);
        }
    }
        
    

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        return [
            // 'age' => ['required', 'regex:/^\d+(,\d+)*$/'], // if we handle as string
            // im handling age as array after converts.
            'age' => ['required', 'array', new ValidAgeGroup(new Ageload())],
            'age.*' => ['integer', 'min:18', 'max:100'],
            'currency_id' => ['required', 'string', 'exists:currencies,currency_id'],
            'start_date' => ['required', 'date', 'date_format:Y-m-d'],
            'end_date' => ['required', 'date', 'date_format:Y-m-d', 'after_or_equal:start_date'],
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
            'age.required' => 'Age is required or more than 0.',
            'age.array' => 'Age must be an array of two integers.',
            'age.*.integer' => 'Each age must be an integer.',
            'age.*.min' => 'Each age must be at least :min years.',

            'currency_id.required' => 'Currency is required.',
            'currency_id.in' => 'Selected currency is invalid.',

            'start_date.required' => 'Start date is required.',
            'start_date.date_format' => 'Start date must be in YYYY-MM-DD format.',
            'end_date.after_or_equal' => 'End date must be after or equal to start date.',
            
        ];
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param \Illuminate\Contracts\Validation\Validator $validator
     * @throws \Illuminate\Http\Exceptions\HttpResponseException
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status' => 'error',
            'errors' => $validator->errors(),
        ], 422));
    }
}
