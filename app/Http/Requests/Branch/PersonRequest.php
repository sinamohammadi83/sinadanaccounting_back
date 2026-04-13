<?php

namespace App\Http\Requests\Branch;

use Illuminate\Foundation\Http\FormRequest;

class PersonRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'province_id' => ['required','integer','exists:provinces,id'],
            'city_id' => ['required','integer','exists:cities,id'],
            'first_name' => ['required','min:3','max:15'],
            'last_name' => ['required','min:3','max:15'],
            'community' => ['nullable','max:100'],
            'mobile' => ['required','max:11'],
            'tel' => ['nullable','max:11','integer'],
            'postal_code' => ['required','max:10'],
            'email' => ['nullable','max:30','email'],
            'website' => ['nullable','max:50'],
            'address' => ['nullable','max:255'],
            'type' => ['required','integer']
        ];
    }
}
