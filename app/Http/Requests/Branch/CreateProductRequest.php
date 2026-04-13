<?php

namespace App\Http\Requests\Branch;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
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
            'storage_id' => ['required','exists:storages,id'],
            'category_id' => ['required','exists:categories,id'],
            'name' => ['required','min:3','max:255'],
            'buy_price' => ['required','integer','min:1000','max:1000000000'],
            'sell_price' => ['required','integer','min:1000','max:1000000000'],
            'pic' => ['required','mimes:png,jpg,webp','max:2048'],
            'count' => ['required','integer','min:1','max:2000'],
        ];
    }
}
