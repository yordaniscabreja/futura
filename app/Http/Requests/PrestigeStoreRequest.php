<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PrestigeStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'reputacion_institucional' => ['required', 'numeric'],
            'practicas_profesionales' => ['required', 'numeric'],
            'imagen_egresado' => ['required', 'numeric'],
            'asociaciones_externas' => ['required', 'numeric'],
            'bolsa_empleo' => ['required', 'numeric'],
            'university_id' => ['required', 'exists:universities,id'],
        ];
    }
}
