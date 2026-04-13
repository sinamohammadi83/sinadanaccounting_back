<?php

namespace App\Http\Requests\Branch;

use Illuminate\Foundation\Http\FormRequest;

class CreateFactorRequest extends FormRequest
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
            'category_id' => ['required','exists:categories,id'],
            'person_id' => ['required','exists:people,id'],
            'title' => ['required','min:3','max:50'],
            'date' => ['required','date'],
            'due_date' => ['required','date'],
            'paid_price' => ['required','integer'],
            'products' => ['required','array']
        ];
    }
}
