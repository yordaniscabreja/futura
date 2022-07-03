<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WellnessStoreRequest extends FormRequest
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
            'orientacion_psicologia' => ['required', 'numeric'],
            'actividades_deportivas' => ['required', 'numeric'],
            'actividades_culturales' => ['required', 'numeric'],
            'plan_covid19' => ['required', 'numeric'],
            'felicidad_entorno' => ['required', 'numeric'],
            'academic_program_id' => [
                'required',
                'exists:academic_programs,id',
            ],
        ];
    }
}
