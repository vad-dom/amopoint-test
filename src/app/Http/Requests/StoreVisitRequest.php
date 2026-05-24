<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreVisitRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'page_url' => ['nullable', 'url', 'max:2000'],
            'referer' => ['nullable', 'url', 'max:2000'],
            'screen' => ['nullable', 'string', 'max:50'],
            'language' => ['nullable', 'string', 'max:20'],
        ];
    }
}
