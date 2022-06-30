<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LifeStyleUpdateRequest extends FormRequest
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
            'ambiente' => ['required', 'numeric'],
            'diversion_ocio' => ['required', 'numeric'],
            'descanso_relax' => ['required', 'numeric'],
            'cultura_ecologica' => ['required', 'numeric'],
            'servicio_estudiante' => ['required', 'numeric'],
            'university_id' => ['required', 'exists:universities,id'],
        ];
    }
}
