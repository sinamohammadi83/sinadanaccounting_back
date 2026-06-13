<?php

namespace App\Http\Requests\Branch;

use Illuminate\Foundation\Http\FormRequest;

class CreateStaffRequest extends FormRequest
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
            'name' => ['required','min:3'],
            'family' => ['required','min:3'],
            'mobile' => ['required','min:11','max:11','unique:staff,mobile'],
            'national_code' => ['required','min:10','max:10','unique:staff,national_code'],
            'education' => ['required'],
            'role' => ['required','min:3','max:20'],
            'role_id' => ['required','integer','exists:roles,id'],
            'father_name' => ['required','min:3','max:20'],
            'address' => ['required','min:3','max:255'],
        ];
    }
}
