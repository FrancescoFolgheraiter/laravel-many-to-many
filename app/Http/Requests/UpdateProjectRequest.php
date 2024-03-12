<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

// Helpers
use Illuminate\Support\Facades\Auth;

class UpdateProjectRequest extends FormRequest
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
            'name' => 'required|max:255',
            'thumb' => 'nullable|image',
            'description' => 'nullable|max:5000',
            'type_id' => 'nullable|exists:types,id',
            'start_date' => 'required|date',
            'last_update_date' => 'nullable|date',
            'total_hours' => 'nullable|numeric|max:999',
            'technologies'=>'nullable|array|exists:technologies,id',
            'delete_img' => 'nullable|boolean'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Il campo nome è obbligatorio.',
            'name.max' => 'Il campo nome non può superare i 255 caratteri.',
            'thumb.url' => 'Il campo thumb deve essere un URL valido.',
            'description.max' => 'Il campo descrizione non può superare i 5000 caratteri.',
            'type_id.required' => 'Il campo tipo è obbligatorio.',
            'type_id.exists' => 'Il tipo selezionato non è valido.',
            'start_date.required' => 'Il campo data di inizio è obbligatorio.',
            'start_date.date' => 'Il campo data di inizio non è una data valida.',
            'last_update_date.date' => 'Il campo data di ultimo aggiornamento non è una data valida.',
            'total_hours.numeric' => 'Il campo ore totali deve essere un valore numerico.',
            'total_hours.max' => 'Il campo ore totali non può superare 999.',
        ];
    }
}
