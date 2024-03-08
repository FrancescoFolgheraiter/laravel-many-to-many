<?php

namespace App\Http\Requests\type;

use Illuminate\Foundation\Http\FormRequest;

// Helpers
use Illuminate\Support\Facades\Auth;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:64',
            'version' => 'nullable|max:64',
            'description' => 'nullable|max:1000',
        ];
    }
    //msg personalizzati
    public function messages(): array
    {
        return [
            'name.required' => 'Il nome è obbligatorio.',
            'name.max' => 'Il nome non può superare i 64 caratteri.',
            'version.max' => 'La versione non può superare i 64 caratteri.',
            'description.max' => 'La descrizione non può superare i 1000 caratteri.',
        ];
    }
}
