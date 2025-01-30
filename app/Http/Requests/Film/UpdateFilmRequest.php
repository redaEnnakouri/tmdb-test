<?php

namespace App\Http\Requests\Film;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateFilmRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'overview' => 'nullable|string|max:1005',
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
            'title.required' => 'Le champ titre est obligatoire',
            'title.string' => 'Le champ titre doit être une chaîne de caractères',
            'title.max' => 'Le champ titre ne doit pas dépasser 255 caractères',
            'overview.string' => 'Le champ description doit être une chaîne de caractères',
            'overview.max' => 'Le champ description ne doit pas dépasser 1005 caractères',
        ];
    }
}
