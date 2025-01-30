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
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string|max:1005',
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
            'titre.required' => 'Le champ titre est obligatoire',
            'titre.string' => 'Le champ titre doit être une chaîne de caractères',
            'titre.max' => 'Le champ titre ne doit pas dépasser 255 caractères',
            'description.string' => 'Le champ description doit être une chaîne de caractères',
            'description.max' => 'Le champ description ne doit pas dépasser 1005 caractères',
        ];
    }
}
